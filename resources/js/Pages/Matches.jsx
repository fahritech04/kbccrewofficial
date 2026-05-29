import { MATCHES_PAGE_TITLE } from '../Features/Matches/constants';
import MatchesPageContent from '../Features/Matches/Pages/MatchesPageContent';
import PublicPageLayout from '../Features/Site/Layouts/PublicPageLayout';

export default function Matches({ upcomingMatches, recentMatches }) {
    return (
        <PublicPageLayout title={MATCHES_PAGE_TITLE}>
            <MatchesPageContent
                upcomingMatches={upcomingMatches ?? []}
                recentMatches={recentMatches ?? []}
            />
        </PublicPageLayout>
    );
}
