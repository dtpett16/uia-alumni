 4.0 Utvikling av prototypen (Leveranse -- del 2)
=================================================

Del 2 av leveransen til kunden fra gruppen SED Alumni er prototypen, som
skal bistå i å visualisere hvordan et alumni-system kan se ut. Vår
gruppe har valgt ut en rekke funksjoner som vi mente var relevante å
visualisere basert på fortsettelsen av analysen. Utgangspunktet er
fortsatt i funksjoner beskrevet i kravspesifikasjonen, med noen egen
analyse inne i bildet.

Live prototypen kan besøkes på alumniuia.wpengine.com

Send e-post til dtpett16@student.uia.no for å få mer informasjon om hvordan å bidra på den live-installasjonen med Wordpress frontend.

4.1 Brukerhistorier
-------------------

Vi har utformet brukerhistorier basert på utredningen til
prosjektgruppen, egne intervjuer og undersøkelser som vi har gjennomført
(Vedlegg 6: Undersøkelser av Bachelorgruppen) og
kravspesifikasjonsdokumentet. Brukerhistoriene gir et utgangspunkt for å
utforme rike bilder, tilstandsdiagrammer og legger til rette for
implementasjonen av en enkel funksjonell prototype. Figurene på de neste
sidene viser hvordan disse tabellene ser ut. Nummer på hver
brukerhistorie er også en prioritering på hvor viktig brukerhistorien
er, i tillegg til MoSCoW-prioriteringen.

![Brukerhistorietabell](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/Userstory%20part%201.PNG)

![Brukerhistorietabell](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/Userstory%20part%202.PNG)

![Brukerhistorietabell](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/Userstory%20part%203.PNG)

4.2 Rikt bilde
--------------

Det første rike bildet (Figur 15) viser hvordan arrangementer går mellom
en administrator og en alumni. Administrator kan se eller skape et
arrangement eller se liste over påmeldet alumner til et arrangement. En
alumni kan se arrangementer og melde seg på etter å ha sett den. Når en
alumni har meldt seg på så for vedkommende en bekreftelse på påmelding,
som også administrator for vite om. En alumni kan også melde seg av et
arrangement, og får igjen en bekreftelse på avmedling.

![Rikt bilde 1](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/richpic1.jpg)

Det neste rike bildet (Figur 16) viser hvordan administrator kan
opprette eller slette en nyhet. Administrator går fra hjemmesiden til
nyheter, og kan deretter lage en nyhet eller redigere en eksiterende
nyhet. Fra redigerte nyheter kan administrator slette nyheten som gjør
at administrator blir sendt tilbake til nyhetssiden.

![Rikt bilde 2](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/richpic2.jpg)

4.3 Klassediagram
-----------------

Under analysen var det rike bilder som gav inspirasjon til å utforme et
klassediagram. Versjon 1 ble utredet tidlig i analysefasen, og ble brukt
for å gir retning til hvordan prototypen vil bli. Etter en gjennomgang
med veilederen fikk vi tilbakemeldinger om mulige forbedringer. Som
følge av dette ble versjon 2 utredet. Versjon 2 gir grunnlaget for andre
modeller i analysefasen.

![Klassediagram](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/klassediagram.png)

4.4 Tilstandsdiagram
--------------------

Tilstandsdiagrammet for arrangement (Figur 18) viser at administrator
oppretter et arrangement som går til deaktivert tilstand. Her kan
administrator endre på arrangementet, eller velge å slette den. Videre
kan administrator publisere arrangementet til aktiv tilstand.
Administrator kan redigere arrangementet uten å deaktivere den. Den
forblir aktiv frem til administrator velger å deaktivere eller slette
den.

![Tilstandsdiagram 1](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/tilstandarrangement.png)

I de andre tilstandsdiagrammet for arrangement (Figur 19) starter
brukeren starter med å velge et spesifikt arrangement. Når arrangementet
er valgt går den i tilstanden «arrangement valgt». Deretter kan brukeren
melde seg på, og nå påmeldingstilstanden. Informasjonen blir lagt inn.
Når informasjonen er utfylt er bruker påmeldt til arrangement. Prosessen
kan deretter starte på nytt ved å velge et nytt arrangement.

![Tilstandsdiagram 2](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/tilstandp%C3%A5melding.png)

4.5 Prototype
-------------

Resultatet av analysen resulterer i en funksjonell prototype utviklet i
Wordpress. Prototypen i sin helhet kan besøkes på
[[http://alumniuia.wpengine.com/]{.underline}](http://alumniuia.wpengine.com/).
Fokuset til prototypen er rundt samhandlingen av bruker-visningen og
back-end systemet -- i dette tilfellet, Wordpress databasen og de ulike
tilleggsmodulene. Det finnes både administrative og «subscriber»
visninger på siden. Noen bestemmelser har blitt tatt i gruppen for å
beslutte hvordan prototypen skal utformes visuelt. Det er ikke brukt
noen form for versjonskontroll annet en Wordpress sine innebygde backup
funksjoner. På grunn av det mindre omfanget av leveranse del 2, ble en
kortere tidsplan på en måned besluttet å brukes for prototypen.

### 4.5.1 Design principles

Vi baserte oss på Benyon\'s Design principles når vi begynte å designe
prototypen. Benyon\'s Design Principles er gode «best practice»
prinsipper som sentrerer seg rundt hvordan en bruker opplever et visuelt
grensesnitt (Benyon, 2014). Benyon har 12 ulike prinsipper som vi også
tar utgangspunkt i for å lage prototypen. Å bruke disse prinsippene er
en enkel og rask måte å sikre at kunden får en god opplevelse av å bruke
prototypen.

Gunn-Marit, prosjektlederen for UiA Alumni, vurderer den funksjonelle
prototypen. Hennes forventninger til prototypen var i tråd med fire
prinsipper som vi valgte å legge vekt på basert på tilbakemeldingen:

-   Visibility: nøkkelfunksjoner er synlige for brukeren.

-   Familiarity: bruke vanlige symboler og gjenkjennbart språk.

-   Style: designen skal være stilig og attraktiv -- gjøre brukeren
    interessert i løsningen.

-   Affordance: design skal være i tråd med ønsket funksjonalitet og
    hensikt med løsningen.

Det ble også aktuelt å ta utgangspunkt i Universitetet i Agder sin
profilmanual for farger, dette for å gjøre prototypen gjenkjennbart med
andre nettsider til UiA. Prinsippene over er bare fire av flere
prinsipper som vi tar i bruk i prototypen etter hvert som vi la til
funksjonalitet.

Videre er det noen beskrivelser på utformingen av prototypen.

**\
**

**Hovedside:**\
Figur 20: Hovedsiden til Prototypen viser hvordan hovedsiden til UiA
Alumni kan se ut. Fargekoden er bestemt fra UiA sin profilmanual, mens
kategoriene er inspirert fra NTNU sin alumni nettside. Gunn-Marit,
prosjektlederen, godkjente den kategoriinndelingen, bedømt som passende
også for UiA. Øverst har nettsiden en standard menylinje hvor brukeren
kan navigere siden. Disse knappene er de som alltid er tilgjengelig og
regnet som muligens mest brukte. Til venstre brukes det en kalender som
viser neste arrangement. Etter første gjennomgang av prototypen ønsket
prosjektlederen en kalenderimplementasjon. Det er også et søkefelt og
beskrivelse av alumni nettsiden. Hovedsiden prøver å ha fokus på hva en
bruker kan interessere seg mest for.

![Hovedside](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/hovedside.PNG)

**Innlogging:**\
Figur 21: Innlogging til Alumni viser hvordan en bruker vil kunne logge
seg på UiA Alumni, ved bruk av enten bruker navn eller e-post adresse
sammen med passord. Brukeren kan også bruke «Social Login» for å
forenkle innloggingsprosessen. I dag har vi så langt kun implementert
Google Login. Enkelte standard knapper som «Husk meg» er også lagt til
slik at brukeren ikke trenger å logge seg inn på nytt hver gang. Dersom
vedkommende ikke er en bruker er det mulig å registrere seg.
Passordgjenoppretting er også funksjonelt, dersom bruker glemmer
passordet.

![Innlogging](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/innlogging.PNG)

**Profilfunksjoner:**

Figur 22: Profilfunksjoner viser noen av funksjonene en bruker kan få
tilgang til. Brukeren kan tilpasse sin egen informasjon, se varlinger,
eller annen aktivitet.

![Profilfunksjoner](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/profilfunksjoner.PNG)

**Min profil:**\
Figur 23: Egen profil for bruker viser hvordan profilen til en bruker
kan se ut. Brukeren kan gjøre endringer til profilen som kan være
synlige eller private for andre brukere.

![Min Profil](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/min%20profil.PNG)

**Mitt nettverk:**

Figur 24: Nettverket til brukere viser medlemmer i UiA Alumni nettverket
og sist de medlemmene var aktive. Mitt nettverk kan brukes for å
kontakte andre brukere ved bruk av e-post. Det er også mulig for
administratorer (f.eks. foreleser) å finne potensielle gjesteforelesere.
Mitt nettverk har også et eget søkefelt for å inne bestemte brukere, i
tillegg til en funksjon for å sortere brukere tilknyttet til et bestemt
fakultet (ikke implementert).

![Mitt Nettverk](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/Mitt%20nettverk.PNG)

**Arrangementer:**

Figur 25: Arrangementer viser hvordan brukeren kan se arrangementer
(events) som skjer i fremtiden. Brukeren kan selv søke etter
arrangementer eller bruke «Pinboard» knappen for å automatisk vise
arrangementer i en bestemt periode.

![Arrangementer](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/Arrangementer.PNG)

**Påmelding arrangementer:**

Figur 26: Påmelding arrangementer viser hvordan en bruker kan bruke et
påmeldingsskjema for å melde seg på et arrangement. Noe av informasjonen
kan være valgfri. Brukeren vil få påmeldingsinformasjon via e-post.

![Påmelding arrangement](https://github.com/dtpett16/uia-alumni/blob/master/vedlegg/p%C3%A5melding%20arr..PNG)

Det var i utgangspunktet ønskelig å bruke prototypen for å bistå
utformingen av kravspesifikasjonen. Istedenfor ble den utviklet og
testet for å materialisere kravspesifikasjonen.
