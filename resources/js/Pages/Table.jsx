import { Head } from '@inertiajs/react';
import { TABLE_PAGE_TITLE } from '../Features/Table/constants';
import TablePageContent from '../Features/Table/Pages/TablePageContent';
import PublicSiteLayout from '../Features/Site/Layouts/PublicSiteLayout';

export default function Table({ standings, leader }) {
    return (
        <>
            <Head title={TABLE_PAGE_TITLE} />

            <PublicSiteLayout>
                <TablePageContent standings={standings ?? []} leader={leader} />
            </PublicSiteLayout>
        </>
    );
}
