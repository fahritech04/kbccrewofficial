import { Head } from '@inertiajs/react';
import { MATCHES_PAGE_TITLE } from '../Features/Matches/constants';
import MatchesPageContent from '../Features/Matches/Pages/MatchesPageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Matches({ upcomingMatches, recentMatches }) {
    return (
        <>
            <Head title={MATCHES_PAGE_TITLE} />

            <PublicSiteLayout>
                <MatchesPageContent
                    upcomingMatches={upcomingMatches ?? []}
                    recentMatches={recentMatches ?? []}
                />
            </PublicSiteLayout>
        </>
    );
}
