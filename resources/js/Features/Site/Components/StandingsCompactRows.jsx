import { formatPointDiff } from '../utils/standings';

export default function StandingsCompactRows({ standings, thirdColumnValue }) {
    return (
        <div className="kbc-table-list">
            {standings.map((standing) => (
                <div key={standing.id} className="kbc-table-row">
                    <p>{standing.position}</p>
                    <div>
                        <strong>{standing.team.short_name}</strong>
                    </div>
                    <p>{thirdColumnValue(standing)}</p>
                    <p>{formatPointDiff(standing.point_diff)}</p>
                    <p>{standing.points}</p>
                </div>
            ))}
        </div>
    );
}
