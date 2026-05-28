import { SITE_FALLBACK_IMAGE } from '../Site/constants';

export function trimText(text, maxLength = 120) {
    if (!text) {
        return '';
    }

    return text.length > maxLength ? `${text.slice(0, maxLength)}...` : text;
}

export function toProxyImageUrl(url) {
    return url
        ? `/instagram/media?src=${encodeURIComponent(url)}`
        : SITE_FALLBACK_IMAGE;
}
