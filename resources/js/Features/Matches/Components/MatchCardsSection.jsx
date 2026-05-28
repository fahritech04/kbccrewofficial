import { formatMatchDate, formatMatchTime } from '../../Site/utils/date';

export default function MatchCardsSection({ title, matches, emptyMessage }) {
    return (
        <section className="kbc-section">
            <div className="kbc-section-head">
                <h2>{title}</h2>
            </div>

            {matches.length === 0 ? (
                <p className="kbc-ig-status is-info">{emptyMessage}</p>
            ) : (
                <div className="kbc-match-grid">
                    {matches.map((match) => (
                        <article key={match.id} className="kbc-match-card">
                            <p className="kbc-round">{match.round}</p>
                            <div className="kbc-match-teams">
                                <span>{match.home_team.short_name}</span>
                                <strong>{match.scoreboard}</strong>
                                <span>{match.away_team.short_name}</span>
                            </div>
                            <p className="kbc-match-info">
                                {formatMatchDate(match.match_date)} | {formatMatchTime(match.match_date)}
                            </p>
                            <p className="kbc-match-info">{match.venue}</p>
                        </article>
                    ))}
                </div>
            )}
        </section>
    );
}
