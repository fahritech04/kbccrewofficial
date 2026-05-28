import { FALLBACK_IMAGE } from './constants';

export const formatDate = (date) =>
    new Date(date).toLocaleDateString('id-ID', {
        day: '2-digit',
        month: 'short',
    });

export const formatTime = (date) =>
    new Date(date).toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
    });

export function buildCardsFromNews(news, count, sectionKey) {
    if (!news?.length) {
        return [];
    }

    return Array.from({ length: count }, (_, index) => {
        const item = news[index % news.length];

        return {
            id: `${sectionKey}-${item.id}-${index}`,
            title: item.title,
            category: item.category,
            image: item.image_url ?? FALLBACK_IMAGE,
        };
    });
}

export function buildSectionCards(news, sections) {
    return sections.reduce((acc, section) => {
        acc[section.key] = buildCardsFromNews(news, section.count, section.key);
        return acc;
    }, {});
}

