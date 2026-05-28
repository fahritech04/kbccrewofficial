export const formatMatchDate = (date) =>
    new Date(date).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
    });

export const formatMatchTime = (date) =>
    new Date(date).toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
    });

export const formatMatchDayLabel = (date) =>
    new Date(date).toLocaleDateString('id-ID', {
        weekday: 'short',
        day: 'numeric',
        month: 'short',
    });

export const toLocalDateKey = (date) => {
    if (!date) {
        return null;
    }

    const localDate = date instanceof Date ? date : new Date(date);

    if (Number.isNaN(localDate.getTime())) {
        return null;
    }

    const year = localDate.getFullYear();
    const month = String(localDate.getMonth() + 1).padStart(2, '0');
    const day = String(localDate.getDate()).padStart(2, '0');

    return `${year}-${month}-${day}`;
};

const createLocalDate = (year, month, day) => new Date(year, month - 1, day);

const dateFromLocalDateKey = (key) => {
    if (!key) {
        return null;
    }

    const parts = key.split('-').map(Number);
    if (parts.length !== 3 || parts.some((part) => Number.isNaN(part))) {
        return null;
    }

    return createLocalDate(parts[0], parts[1], parts[2]);
};

const addDays = (date, days) => {
    const next = new Date(date);
    next.setDate(next.getDate() + days);
    return next;
};

export const toWeekStartKey = (date) => {
    const dateKey = toLocalDateKey(date);
    const localDate = dateFromLocalDateKey(dateKey);

    if (!localDate) {
        return null;
    }

    // Senin sebagai awal minggu (1..7)
    const dayOfWeek = localDate.getDay() === 0 ? 7 : localDate.getDay();
    const monday = addDays(localDate, 1 - dayOfWeek);

    return toLocalDateKey(monday);
};

const formatDayAndMonth = (date) =>
    date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'short',
    });

export const formatWeekRangeLabel = (weekStartKey) => {
    const weekStart = dateFromLocalDateKey(weekStartKey);
    if (!weekStart) {
        return '';
    }

    const weekEnd = addDays(weekStart, 6);
    const startWeekday = weekStart.toLocaleDateString('id-ID', { weekday: 'short' });
    const endWeekday = weekEnd.toLocaleDateString('id-ID', { weekday: 'short' });

    return `${startWeekday}, ${formatDayAndMonth(weekStart)} - ${endWeekday}, ${formatDayAndMonth(weekEnd)}`;
};
