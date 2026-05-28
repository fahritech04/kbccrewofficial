import { Head } from '@inertiajs/react';
import { PLAYERS_PAGE_TITLE } from '../Features/Players/constants';
import PlayersPageContent from '../Features/Players/Pages/PlayersPageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Players({ spotlightTeams, stories }) {
    return (
        <>
            <Head title={PLAYERS_PAGE_TITLE} />

            <PublicSiteLayout>
                <PlayersPageContent
                    spotlightTeams={spotlightTeams ?? []}
                    stories={stories ?? []}
                />
            </PublicSiteLayout>
        </>
    );
}
