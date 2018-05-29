<?
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=calendar.ics");
//echo "BEGIN:VCALENDAR\n";
//echo "VERSION:2.0\n";
//echo "PRODID:-//Datamace Informática//NONSGML Datamace//EN\n";
//echo "METHOD:REQUEST\n"; // requied by Outlook
//echo "BEGIN:VEVENT\n";
//echo "UID:".date('Ymd').'T'.date('His')."-".rand()."-example.com\n"; // required by Outlok
//echo "DTSTAMP:".date('Ymd').'T'.date('His')."\n"; // required by Outlook
//echo "DTSTART:20111205T101059\n"; 
//echo "SUMMARY:". date('Ymd') ."\n";
//echo "DESCRIPTION: Resumo do Evento\n" ;
//echo "END:VEVENT\n";
//echo "END:VCALENDAR\n";
echo"BEGIN:VCALENDAR
CALSCALE:GREGORIAN
VERSION:2.0
PRODID:-//CALENDARSERVER.ORG//NONSGML Version 1//EN
METHOD:REQUEST
BEGIN:VEVENT
DESCRIPTION:Resumo do Evento
DTEND:20111205T101059
DTSTART;TZID=America/Sao_Paulo:20111205T100000
DTEND;TZID=America/Sao_Paulo:20111205T200000
LAST-MODIFIED:20111205T190342Z
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:Festa Stela
TRANSP:OPAQUE
UID:20111205T170104-302453506-example.com
DTSTAMP:20111205T190354Z
END:VEVENT
END:VCALENDAR";
?>