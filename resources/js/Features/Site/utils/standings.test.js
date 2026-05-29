import assert from 'node:assert/strict';
import test from 'node:test';
import {
    buildRecentForm,
    calculateDraws,
    formatPointDiff,
} from './standings.js';

test('formatPointDiff handles positive, zero, null, and negative values', () => {
    assert.equal(formatPointDiff(12), '+12');
    assert.equal(formatPointDiff(0), '0');
    assert.equal(formatPointDiff(null), '0');
    assert.equal(formatPointDiff(-7), '-7');
});

test('calculateDraws computes played - won - lost and never below zero', () => {
    assert.equal(calculateDraws({ played: 8, won: 6, lost: 1 }), 1);
    assert.equal(calculateDraws({ played: 2, won: 2, lost: 2 }), 0);
});

test('buildRecentForm returns exactly 5 items with W/D/L composition', () => {
    assert.deepEqual(
        buildRecentForm({ played: 8, won: 6, lost: 2 }),
        ['W', 'W', 'W', 'L', 'L'],
    );
});

test('buildRecentForm left-pads with D when less than 5 results', () => {
    assert.deepEqual(
        buildRecentForm({ played: 2, won: 1, lost: 0 }),
        ['D', 'D', 'D', 'W', 'D'],
    );
});
