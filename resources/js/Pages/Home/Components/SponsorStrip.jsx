export default function SponsorStrip({ sponsors }) {
    return (
        <section className="kbc-sponsor-strip">
            {sponsors.map((sponsor) => (
                <div key={sponsor} className="kbc-sponsor">
                    {sponsor}
                </div>
            ))}
        </section>
    );
}

