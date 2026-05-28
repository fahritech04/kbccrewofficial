import {
    formatMatchDate,
    formatMatchDayLabel,
    formatMatchTime,
} from '../../Site/utils/date';

export default function MatchCardsSection({ title, matches, emptyMessage }) {
    const groupedMatches = matches.reduce((acc, match) => {
        const dayKey = match.match_date?.split('T')?.[0] ?? String(match.id);

        if (!acc[dayKey]) {
            acc[dayKey] = [];
        }

        acc[dayKey].push(match);

        return acc;
    }, {});

    const matchdayGroups = Object.entries(groupedMatches);

    return (
        <section className="kbc-section">
            <div className="kbc-section-head">
                <h2>{title}</h2>
            </div>

            {matches.length === 0 ? (
                <p className="kbc-ig-status is-info">{emptyMessage}</p>
            ) : (
                <div className="kbc-matchday-list">
                    {matchdayGroups.map(([dayKey, dayMatches]) => (
                        <div key={dayKey} className="kbc-matchday-block">
                            <p className="kbc-matchday-date">
                                {formatMatchDayLabel(dayMatches[0]?.match_date)}
                            </p>

                            {dayMatches.map((match) => (
                                <article key={match.id} className="kbc-match-row">
                                    <p className="kbc-match-row-status">
                                        {match.status === 'finished'
                                            ? 'FT'
                                            : match.status === 'live'
                                              ? 'LIVE'
                                              : 'SCH'}
                                    </p>

                                    <div className="kbc-match-row-main">
                                        <div className="kbc-match-row-teams">
                                            <div className="kbc-match-row-team kbc-match-row-team-left">
                                                <span>{match.home_team.name}</span>
                                                {match.home_team.logo_url && (
                                                    <img
                                                        src={match.home_team.logo_url}
                                                        alt={match.home_team.short_name}
                                                    />
                                                )}
                                            </div>

                                            <strong className="kbc-match-row-score">
                                                {match.scoreboard}
                                            </strong>

                                            <div className="kbc-match-row-team kbc-match-row-team-right">
                                                {match.away_team.logo_url && (
                                                    <img
                                                        src={match.away_team.logo_url}
                                                        alt={match.away_team.short_name}
                                                    />
                                                )}
                                                <span>{match.away_team.name}</span>
                                            </div>
                                        </div>

                                        <p className="kbc-match-row-meta">
                                            {formatMatchDate(match.match_date)} |{' '}
                                            {formatMatchTime(match.match_date)}
                                            <span>•</span>
                                            {match.venue}
                                        </p>
                                    </div>
                                </article>
                            ))}
                        </div>
                    ))}
                </div>
            )}
        </section>
    );
}
