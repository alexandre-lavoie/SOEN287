import requests
import random
import json
from collections import defaultdict
import re
from xml.dom import minidom

with open('./data/sitemap-ecomm-en-qc.xml') as h:
    site_xml_source = '\n'.join(h.readlines())

site_xml = minidom.parseString(site_xml_source)

loc_xmls = site_xml.getElementsByTagName('loc')

locs = [loc_xml.firstChild.data for loc_xml in loc_xmls]

product_urls = [loc for loc in locs if '/p/' in loc]

random.shuffle(product_urls)

products = {}

aisles = defaultdict(list)

for product_url in product_urls:
    matches = re.findall(r'https:\/\/www\.metro\.ca\/en\/online-grocery\/aisles\/(.*?)(\/.*)?\/(.*?)\/p\/(.*)', product_url)

    aisle, _, name, id = matches[0]
    
    aisle = ' '.join(word.capitalize() for word in aisle.split('-'))
    name = ' '.join(word.capitalize() for word in name.split('-'))

    aisles[aisle].append(id)

    products[id] = { 'id': id, 'name': name, 'url': product_url }

new_products = {}

for aisle, product_ids in aisles.items():
    aisles[aisle] = aisles[aisle][:3]

    for product_id in aisles[aisle]:
        new_products[product_id] = products[product_id]

with open('./data/products.json', 'w') as h:
    json.dump(new_products, h, indent=4)

with open('./data/aisles.json', 'w') as h:
    json.dump(aisles, h, indent=4)