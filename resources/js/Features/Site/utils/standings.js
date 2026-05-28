export const formatPointDiff = (pointDiff) =>
    pointDiff > 0 ? `+${pointDiff}` : String(pointDiff ?? 0);

export const calculateDraws = (standing) =>
    Math.max(0, (standing.played ?? 0) - (standing.won ?? 0) - (standing.lost ?? 0));

export const buildRecentForm = (standing, maxItems = 5) => {
    const won = standing.won ?? 0;
    const lost = standing.lost ?? 0;
    const drawn = calculateDraws(standing);

    const pool = [
        ...Array.from({ length: won }, () => 'W'),
        ...Array.from({ length: drawn }, () => 'D'),
        ...Array.from({ length: lost }, () => 'L'),
    ];

    const recent = pool.slice(-maxItems);

    while (recent.length < maxItems) {
        recent.unshift('D');
    }

    return recent;
};
