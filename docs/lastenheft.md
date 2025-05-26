# Einleitung

Das vorliegende Lastenheft beschreibt die funktionalen und nicht-funktionalen Anforderungen an die Webanwendung "tinyquest". 
Es dient als Grundlage für die Projektplanung, Angebotserstellung und Vertragsgestaltung. Das Dokument definiert die Rahmenbedingungen für die Umsetzung des Projekts und ist die Basis für das darauffolgende Pflichtenheft.

# Allgemeines

## Ziel und Zweck des Dokuments

Dieses Lastenheft legt die Anforderungen an die zu entwickelnde Webanwendung "TinyQuest" fest. Die App soll Nutzer motivieren, ihren Alltag durch kleine, tägliche Herausforderungen positiver zu gestalten.

## Ausgangssituation

Viele Menschen suchen nach einfachen Wegen, mehr Struktur, Motivation oder positive Gewohnheiten in ihren Alltag zu integrieren. 
Oft fehlt jedoch der richtige Anstoß. 
Eine App, die auf kleine, spaßige Challenges setzt, kann hier niederschwellig helfen.

## Projektbezug

Das Projekt ist ein eigenständiges Vorhaben im Rahmen eines studentischen Softwareprojekts. Es hat keinen Bezug zu vorhergehenden oder parallelen Projekten.

## Abkürzungen

MVP: Minimum Viable Product

## Verteiler und Freigabe

Dieses Dokument wird dem Projektteam, der betreuenden Lehrperson sowie ggf. weiteren beteiligten Personen zur Verfügung gestellt.  
Es dient als abgestimmte Grundlage zur Entwicklung der Anwendung.  
Eine offizielle Freigabe erfolgt durch die Projektleitung bzw. die betreuende Lehrperson.

# Konzept

## Ziel(e) des Anbieters

Ziel ist es, eine funktionierende Webanwendung mit moderner Benutzeroberfläche zu entwickeln, die Studierende in einem begrenzten Zeitraum umsetzen können. Gleichzeitig soll das Projekt die Grundlage für weiteres Wachstum und Feature-Erweiterungen bilden.

## Ziel(e) und Nutzen des Anwenders

Nutzer erhalten täglich eine neue Mini-Challenge. Durch das Erledigen dieser Aufgaben sammeln sie Punkte oder Streaks und können ihre Motivation steigern. Die App fördert ein positives Verhalten, mehr Bewusstsein im Alltag und kann langfristig helfen, Routinen zu entwickeln.

## Zielgruppe(n)

Die Zielgruppe umfasst vor allem Jugendliche und junge Erwachsene im Alter von 16–30 Jahren, die offen für digitale Motivationstools sind. Sie legen Wert auf Benutzerfreundlichkeit, Design und kleinen spielerischen Anreiz.

# Funktionale Anforderungen

4.1 Registrierung und Login

Nutzer sollen sich registrieren und einloggen können, um ihre Fortschritte zu speichern.

4.2 Weekly-Challenge

Die App zeigt wöchentlich eine Challenge an, die für alle Nutzer identisch ist.

4.3 Tages-Challenges

Die App zeigt täglich Mini-Challenges an, die von den Nutzern angenommen und erfüllt werden können.

4.4 Challenge als erledigt markieren

Nutzer können Challenges abhaken und erhalten dafür Punkte oder einen Fortschrittswert.

4.5 Fortschrittsanzeige

Eine Übersicht zeigt den aktuellen Streak, erledigte Challenges und evtl. Badges.

# Nichtfunktionale Anforderungen

5.1 Design und UI

Ansprechendes und benutzerfreundliches Design

5.2 Gesetzliche Anforderungen

Personenbezogene Daten (z. B. Name, E-Mail, Passwort) werden gemäß DSGVO verarbeitet.  
Passwörter werden nicht im Klartext gespeichert, sondern mit einem sicheren Hash-Verfahren verschlüsselt (bcrypt).  
Die Anwendung wird eine Datenschutzerklärung und einen Cookie-Hinweis enthalten.

5.3 Technische Anforderungen

Die Anwendung wird als klassische Client-Server-Webanwendung auf Basis von PHP (Backend) und MySQL (Datenbank) entwickelt.  
Für das Frontend wird HTML, JavaScript und das CSS-Framework Bootstrap 5 verwendet.  
Die Anwendung wird für die Projektlaufzeit auf einem kostenlosen Webhoster (InfinityFree) bereitgestellt.

# Lieferumfang

6.1 Lieferumfang

Web-Anwendung tinyquest

Dokumentation

6.2 Kosten

Für die Entwicklung und Bereitstellung der Anwendung im Rahmen dieses studentischen Projekts entstehen aktuell keine externen Kosten. 
Es wird ein kostenloser Webhoster (InfinityFree) genutzt, und die Entwicklungsarbeit erfolgt ausschließlich durch das Projektteam selbst.

Langfristig betrachtet könnten im Falle einer Weiterentwicklung oder eines professionellen Betriebs jedoch folgende Kostenpunkte entstehen:

- **Webhosting und Domain:** Für den zuverlässigen und DSGVO-konformen Betrieb einer produktiven Version wäre ggf. ein kostenpflichtiger Webhoster mit eigener Domain notwendig.
- **Sicherheits- und Datenschutzmaßnahmen:** Bei wachsender Nutzerzahl könnten zusätzliche Aufwände für SSL-Zertifikate, Datensicherung und Datenschutzberatung entstehen.
- **Design und Usability:** Optional könnten Mittel für professionelles UI/UX-Design oder externe Tools (z. B. für Analytics) notwendig werden.

Diese Punkte sind derzeit nicht budgetiert, sollten aber im Falle einer Weiterverwendung oder Öffnung der App für die Öffentlichkeit berücksichtigt werden.

6.3 Liefertermin

02. Juni 2025

6.4 Ansprechstelle

Sebastian Bichler, Abgabe via Github Repository

7 Abnahmevoraussetzungen

Das Projekt gilt als abgeschlossen, wenn:

Alle funktionalen Anforderungen prototypisch umgesetzt wurden

Die Anwendung ohne Fehler lauffähig ist

Die Dokumentation vollständig vorliegt

Die Anwendung präsentiert und nachvollziehbar demonstriert wurde

