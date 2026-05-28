import { Head } from '@inertiajs/react';
import { CLUBS_PAGE_TITLE } from '../Features/Clubs/constants';
import ClubsPageContent from '../Features/Clubs/Pages/ClubsPageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Clubs({ clubs }) {
    return (
        <>
            <Head title={CLUBS_PAGE_TITLE} />

            <PublicSiteLayout>
                <ClubsPageContent clubs={clubs ?? []} />
            </PublicSiteLayout>
        </>
    );
}
