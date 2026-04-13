// --- STATE ---
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

// --- KALENDER ---
function renderCalendar() {
    const monthYearLabel = document.getElementById('calendar-month-year');
    const daysContainer = document.getElementById('calendar-days');
    if (!monthYearLabel || !daysContainer) return;

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    const today = new Date();

    monthYearLabel.innerHTML = `${months[currentMonth]} ${currentYear}`;
    daysContainer.innerHTML = '';

    let emptySlots = firstDay === 0 ? 6 : firstDay - 1;
    for (let i = 0; i < emptySlots; i++) {
        daysContainer.innerHTML += `<div class="py-1.5 text-transparent">0</div>`;
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const isToday = day === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear();
        const dayClass = isToday ? 'bg-[#730c1e] text-white font-black shadow-lg shadow-[#730c1e]/20' : 'text-gray-300 hover:bg-white/10 hover:text-white';
        daysContainer.innerHTML += `<div class="py-1.5 rounded transition-all cursor-pointer ${dayClass}">${day}</div>`;
    }
}

window.changeMonth = function(step) {
    currentMonth += step;
    if (currentMonth > 11) { currentMonth = 0; currentYear++; }
    else if (currentMonth < 0) { currentMonth = 11; currentYear--; }
    renderCalendar();
};

// --- JAM ---
function updateClock() {
    const clockMain = document.getElementById('clock-main');
    const clockSeconds = document.getElementById('clock-seconds');
    if (!clockMain || !clockSeconds) return;

    const now = new Date();
    clockMain.textContent = String(now.getHours()).padStart(2, '0') + ":" + String(now.getMinutes()).padStart(2, '0');
    clockSeconds.textContent = String(now.getSeconds()).padStart(2, '0');
}

// --- INIT ---
document.addEventListener('DOMContentLoaded', () => {
    renderCalendar();
    updateClock();
    setInterval(updateClock, 1000);
});
