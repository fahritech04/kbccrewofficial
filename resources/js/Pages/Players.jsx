import { PLAYERS_PAGE_TITLE } from '../Features/Players/constants';
import PlayersPageContent from '../Features/Players/Pages/PlayersPageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Players({ spotlightTeams, stories }) {
    return (
        <PublicPageLayout title={PLAYERS_PAGE_TITLE}>
            <PlayersPageContent
                spotlightTeams={spotlightTeams ?? []}
                stories={stories ?? []}
            />
        </PublicPageLayout>
    );
}
