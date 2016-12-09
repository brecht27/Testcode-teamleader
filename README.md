# Testcode-teamleader

Required: PHP 5.5 for running the code<br>
Demo: http://www.digital-productions.be/dev/teamleader/

<b><i>index.php</i></b><br>
Het eerste deel is het opbouwen van de 3 arrays van customers, products en orders.<br>
De orders array bestaat uit 3 files in de map example-orders. In de code is het samenvoegen voorzien van de 3 arrays tot 1 geheel.<br>
In het geval dit uit meerdere files zou bestaan en er komen er regelmatig bij heb ik in index2.php een loop geschreven die alle files zal samenvoegen in een nieuwe array. Onafhankelijk van het aantal en de filenames. Dit deel in index1.php kan dus vervangen worden door de index2.php inhoud.<br>
Het 2de deel bestaat uit het beantwoorden van de 3 vragen. Ik heb deze telkens onder elkaar opgebouwd met een titel in het begin.<br>
In de code zelf zijn comments voorzien die duidelijk zullen maken wat waarvoor dient.
<br><br>
<b><i>index2.php</i></b><br>
Zoals hierboven al eerder beschreven heb ik het deel van de orders herschreven. Dit laat toe de map dynamisch uit te lezen, onafhankelijk van de filenames en van het aantal files.
