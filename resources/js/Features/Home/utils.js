import { SITE_FALLBACK_IMAGE } from '../Site/constants';

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
            image: item.image_url ?? SITE_FALLBACK_IMAGE,
        };
    });
}

export function buildSectionCards(news, sections) {
    return sections.reduce((acc, section) => {
        acc[section.key] = buildCardsFromNews(news, section.count, section.key);
        return acc;
    }, {});
}

