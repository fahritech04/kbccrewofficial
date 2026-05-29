import assert from 'node:assert/strict';
import test from 'node:test';
import { resolveImageUrl } from './media.js';

test('resolveImageUrl returns input url when available', () => {
    assert.equal(
        resolveImageUrl('https://example.com/image.jpg'),
        'https://example.com/image.jpg',
    );
});

test('resolveImageUrl returns fallback when input url is empty', () => {
    assert.equal(resolveImageUrl(''), resolveImageUrl(null));
});
