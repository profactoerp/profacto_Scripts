#!/usr/bin/python
# -*- coding: utf-8 -*-
#-------------------------------------------------------------------#
# Copyright extragroup GmbH 2020 - unauthorisierte Weitergabe ist untersagt
# http://www.extrgroup.de
# Autor: Ulf Röttger - ur@extragroup.de
# profacto API-Dokumentation: https://conf.extragroup.de/pages/viewpage.action?pageId=25297229
#-------------------------------------------------------------------#
# Python Beispiel-Implementierung für die profacto API GET-Aufrufe
# 2020-07-24 - v1
#-------------------------------------------------------------------#
import requests # ggf. mit "pip install requests"
import json # ggf. mit "pip install json"

# PARAMETERS
debug = True
token="ABC123" 									# eigenes Token für die Artikel-API hinterlegen, 
protocol="http" 								# unabänderlich derzeit
server="mein.server.ip" 						# eigene Server-Adresse angeben
port="8080" 									# unabänderlich
method="api_get" 								# erstmal zum Holen ausreichend
fields="ArtikelTypenNr" 						# als Komma-Liste ohne Leerzeichen erweitern mit den Feldern, die man haben möchte
query="Breite%3D2800" 							# passende Abfrage stellen - Artikel-Suchfelder sind hier nicht direkt nutzbar!
filename="artikel" 								# Zieldateiname der JSON-Datei

# EXECUTE
url=protocol + "://" + server +":" + port + "/4DAction/" + method +"?token=" + token + "&fields=" + fields + "&query=" + query

response = requests.get(url)
data = response.json()

# DEBUG-VERBOSITY
if debug:
	print url
	print(response.status_code)
	print (type(response.json()))

with open(filename +'.json', 'w') as f:
    json.dump(data, f)
