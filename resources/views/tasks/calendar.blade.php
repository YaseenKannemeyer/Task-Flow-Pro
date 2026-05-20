@extends('layouts.app')

@section('title', 'Task Calendar')

@section('content')
<div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between border-b border-slate-100 pb-5">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">
                Task Calendar
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Visual overview of all workspace tasks by due date.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <button id="prevMonth"
                class="p-2 rounded-lg border border-slate-200 hover:bg-slate-50 transition">
                ‹
            </button>

            <span id="monthLabel"
                class="min-w-[140px] text-center text-sm font-semibold text-slate-700">
            </span>

            <button id="nextMonth"
                class="p-2 rounded-lg border border-slate-200 hover:bg-slate-50 transition">
                ›
            </button>

            <button id="todayBtn"
                class="ml-2 inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-blue-700 transition">
                Today
            </button>
        </div>
    </div>

    <!-- LEGEND -->
    <div class="flex flex-wrap gap-4 text-xs text-slate-500">
        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Pending</span>
        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span> In Progress</span>
        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Completed</span>
        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-red-500"></span> Overdue</span>
        <span class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span> On Hold</span>
    </div>

    <!-- CALENDAR -->
    <div class="bg-white border border-slate-100 rounded-2xl shadow-sm overflow-hidden">

        <div id="dayNames"
             class="grid grid-cols-7 text-xs font-semibold text-slate-500 uppercase tracking-wide bg-slate-50 border-b border-slate-100">
        </div>

        <div id="calGrid" class="grid grid-cols-7"></div>

    </div>
</div>

<!-- OVERLAY -->
<div id="dayOverlay"
     class="fixed inset-0 hidden items-center justify-center z-50">

    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- MODAL -->
    <div class="relative w-full max-w-2xl mx-4 bg-white rounded-3xl shadow-2xl overflow-hidden animate-fadeIn">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 py-4 border-b bg-gradient-to-r from-slate-50 to-white">

            <div>
                <h2 id="overlayTitle"
                    class="text-lg font-bold text-slate-800">
                    Tasks for Day
                </h2>
                <p id="overlaySubtitle"
                   class="text-xs text-slate-500 mt-0.5">
                    Click a task to view details
                </p>
            </div>

            <button id="closeOverlay"
                    class="w-9 h-9 flex items-center justify-center rounded-full
                           bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900
                           transition">
                ✕
            </button>

        </div>

        <!-- CONTENT -->
        <div id="overlayContent"
             class="p-5 space-y-3 max-h-[70vh] overflow-y-auto bg-slate-50">

            <!-- empty state (optional placeholder) -->
            <div class="text-center text-slate-400 text-sm py-10">
                No tasks loaded
            </div>

        </div>

        <!-- FOOTER (optional future use) -->
        <div class="px-6 py-3 border-t bg-white text-xs text-slate-400 flex justify-between">
            <span>Tip: Click outside to close</span>
            <span id="overlayCount"></span>
        </div>

    </div>
</div>
@endsection


@php
    $tasksJson = $tasks->map(function ($t) {
        return [
            'id' => $t->id,
            'title' => $t->title,
            'description' => $t->description,
            'due_date' => optional($t->due_date)->format('Y-m-d'),
            'status' => $t->status,
            'status_label' => $t->status_label,
            'priority' => $t->priority,
            'priority_label' => $t->priority_label,
            'is_overdue' => $t->is_overdue,
            'category' => $t->category ? [
                'name' => $t->category->name,
                'color' => $t->category->color,
            ] : null,
            'assignee' => $t->assignee ? [
                'name' => $t->assignee->name,
                'initials' => $t->assignee->initials,
            ] : null,
        ];
    })->values();
@endphp


@push('scripts')
<script>
(function () {

const tasks = @json($tasksJson);

const today = new Date();
let viewYear = today.getFullYear();
let viewMonth = today.getMonth();

const DAYS = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
const MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];
const MAX = 3;

const grid = document.getElementById('calGrid');
const names = document.getElementById('dayNames');
const label = document.getElementById('monthLabel');

/* overlay */
const overlay = document.getElementById('dayOverlay');
const overlayTitle = document.getElementById('overlayTitle');
const overlayContent = document.getElementById('overlayContent');

DAYS.forEach(d => {
    const el = document.createElement('div');
    el.className = 'py-2 text-center';
    el.textContent = d;
    names.appendChild(el);
});

function pad(n){ return String(n).padStart(2,'0'); }
function ymd(d){
    return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}`;
}

function byDate(){
    return tasks.reduce((m,t)=>{
        if(t.due_date){
            (m[t.due_date] ||= []).push(t);
        }
        return m;
    },{});
}

function openOverlay(date, tasksForDay) {
    overlayTitle.textContent = `Tasks for ${date}`;
    overlayContent.innerHTML = '';

    if (!tasksForDay.length) {
        overlayContent.innerHTML = `<p class="text-sm text-slate-500">No tasks for this day.</p>`;
    } else {
        tasksForDay.forEach(t => {
            const el = document.createElement('div');

            el.className = 'p-3 border rounded-xl bg-slate-50 hover:bg-slate-100 transition';

            el.innerHTML = `
                <a href="/tasks/${t.id}"
                   class="font-semibold text-sm text-slate-800 hover:text-blue-600">
                    ${t.title}
                </a>
                <div class="text-xs text-slate-500 mt-1">
                    ${t.status_label}
                    ${t.assignee ? ' • ' + t.assignee.name : ''}
                </div>
            `;

            overlayContent.appendChild(el);
        });
    }

    overlay.classList.remove('hidden');
    overlay.classList.add('flex');
}

function closeOverlay() {
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
}

document.getElementById('closeOverlay').onclick = closeOverlay;
overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeOverlay();
});

function taskCard(t) {
    const el = document.createElement('div');

    const priorityBar = {
        critical: 'bg-red-500',
        high: 'bg-orange-400',
        medium: 'bg-yellow-400',
        low: 'bg-emerald-400',
    }[t.priority] || 'bg-slate-300';

    el.className = `
        relative bg-white rounded-xl border border-slate-100
        shadow-sm hover:shadow-md transition mb-2 p-2 overflow-hidden
        ${t.is_overdue ? 'ring-1 ring-red-200/70' : ''}
    `;

    el.innerHTML = `
        <div class="absolute left-0 top-0 bottom-0 w-1 ${priorityBar}"></div>

        <div class="pl-2">
            <a href="/tasks/${t.id}"
               class="text-xs font-semibold text-slate-900 hover:text-blue-600 line-clamp-2">
                ${t.title}
            </a>

            ${t.category ? `
                <div class="mt-1">
                    <span class="text-[10px] px-2 py-0.5 rounded-full border"
                          style="color:${t.category.color}; background:${t.category.color}20;">
                        ${t.category.name}
                    </span>
                </div>
            ` : ''}

            <div class="flex justify-between items-center mt-1">
                <span class="text-[10px] px-2 py-0.5 rounded-full border">
                    ${t.status_label}
                </span>

                ${t.assignee ? `
                    <span class="text-[10px] text-slate-500">
                        ${t.assignee.initials}
                    </span>
                ` : ''}
            </div>
        </div>
    `;

    return el;
}

function render(){
    grid.innerHTML = '';
    const map = byDate();

    label.textContent = `${MONTHS[viewMonth]} ${viewYear}`;

    const first = new Date(viewYear, viewMonth, 1);
    const last = new Date(viewYear, viewMonth + 1, 0);
    const start = first.getDay();

    let dayNum = 1;

    for(let i=0;i<42;i++){
        const cell = document.createElement('div');
        cell.className = 'min-h-[110px] border-b border-r border-slate-100 p-2 cursor-pointer hover:bg-slate-50 transition';

        if(i >= start && dayNum <= last.getDate()){
            const date = ymd(new Date(viewYear, viewMonth, dayNum));

            const num = document.createElement('div');
            num.className = 'text-xs font-semibold text-slate-700 mb-1';
            num.textContent = dayNum;
            cell.appendChild(num);

            const dayTasks = map[date] || [];

            cell.onclick = () => openOverlay(date, dayTasks);

            dayTasks.slice(0, MAX).forEach(t => {
                cell.appendChild(taskCard(t));
            });

            if(dayTasks.length > MAX){
                const more = document.createElement('div');
                more.className = 'text-[11px] text-slate-400 font-medium';
                more.textContent = `+${dayTasks.length - MAX} more`;
                cell.appendChild(more);
            }

            dayNum++;
        }

        grid.appendChild(cell);
    }
}

document.getElementById('prevMonth').onclick = () => {
    viewMonth--;
    if(viewMonth < 0){ viewMonth = 11; viewYear--; }
    render();
};

document.getElementById('nextMonth').onclick = () => {
    viewMonth++;
    if(viewMonth > 11){ viewMonth = 0; viewYear++; }
    render();
};

document.getElementById('todayBtn').onclick = () => {
    viewYear = today.getFullYear();
    viewMonth = today.getMonth();
    render();

    // build today's key in same format as calendar
    const todayKey = ymd(today);
    const map = byDate();
    const todaysTasks = map[todayKey] || [];

    openOverlay(todayKey, todaysTasks);
};

render();

})();
</script>
@endpush