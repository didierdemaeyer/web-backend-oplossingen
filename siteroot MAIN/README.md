# How to use?

## Bower
* In de *bower.json* file staat alle informatie over het project
  * Onder dependencies staan alle geïnstalleerde libraries (o.a. SoundJS en TweenJS)
    * Om deze dependencies te installeren run je <code>bower install</code> in de terminal
    * Nu staan normaal gezien alle dependencies in de __/bower_components__ map
* Dependencies toevoegen
  * Op [bower.io](http://bower.io/search/) kun je alle JS bibliotheken zoeken
  * Als je een bibliotheek wil toevegen run je bv <code>bower install jquery -S</code>
    * De -S is zeer belangrijk omdat die automatisch de dependency toevoegt aan de lijst met dependencies in de *bower.json* file
    * Zo kan iemand anders simpel <code>bower install</code> runnen en worden alle niet geïnstalleerde dependencies automatisch toegevoegd
