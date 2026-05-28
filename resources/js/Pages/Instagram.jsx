import { Head } from '@inertiajs/react';
import { INSTAGRAM_PAGE_TITLE } from '../Features/Instagram/constants';
import InstagramPageContent from '../Features/Instagram/Pages/InstagramPageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Instagram({ instagram }) {
    return (
        <>
            <Head title={INSTAGRAM_PAGE_TITLE} />

            <PublicSiteLayout>
                <InstagramPageContent instagram={instagram} />
            </PublicSiteLayout>
        </>
    );
}
