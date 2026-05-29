import { SITE_FALLBACK_IMAGE } from '../constants.js';

export function resolveImageUrl(url, fallback = SITE_FALLBACK_IMAGE) {
    return url || fallback;
}
