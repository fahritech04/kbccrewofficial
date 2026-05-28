import assert from 'node:assert/strict';
import test from 'node:test';
import { formatWeekRangeLabel, toWeekStartKey } from './date.js';

test('toWeekStartKey returns the same key when date is already Monday', () => {
    const monday = new Date(2026, 4, 25, 12, 0, 0); // Senin, 25 Mei 2026 (lokal)
    assert.equal(toWeekStartKey(monday), '2026-05-25');
});

test('toWeekStartKey maps Sunday to previous Monday', () => {
    const sunday = new Date(2026, 4, 31, 12, 0, 0); // Minggu, 31 Mei 2026 (lokal)
    assert.equal(toWeekStartKey(sunday), '2026-05-25');
});

test('toWeekStartKey maps mid-week date to its Monday key', () => {
    const thursday = new Date(2026, 4, 28, 12, 0, 0); // Kamis, 28 Mei 2026 (lokal)
    assert.equal(toWeekStartKey(thursday), '2026-05-25');
});

test('formatWeekRangeLabel formats Monday-Sunday range in Indonesian locale', () => {
    assert.equal(
        formatWeekRangeLabel('2026-05-25'),
        'Sen, 25 Mei - Min, 31 Mei',
    );
});

test('formatWeekRangeLabel returns empty string for invalid input', () => {
    assert.equal(formatWeekRangeLabel('invalid-date'), '');
    assert.equal(formatWeekRangeLabel(null), '');
});
