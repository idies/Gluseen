<?php
/**
 * d3

 */
 

elgg_register_event_handler('init', 'system', 'about_init');



/**
 * Init d3 plugin.
 */
function about_init() {


	
	elgg_register_page_handler('about', 'about_page_handler');




	
}


function about_page_handler() {






$params = array(
        'title' => 'Biotic and Abiotic Drivers of Decomposition Rates in Urban Soils:
a Proof of Concept for a Global Experimental Network',
        'content' => '
		<style>
		.sub{
			!important;
		}
		
		</style>
		<h2>Introduction</h2>
		<p>
		Urban
soils
provide
many
of
the
same
ecosystem
services
as
“natural”
or
agricultural
soils
e.g.
decomposition
and
nutrient
cycling,
water
purification
and
regulation,
medium
for
plant
growth,
and
habitat
for
an
enormous
diversity
of
organisms.
Soil
biota
and
substrate
quality,
along
with
abiotic
factors,
such
as
climate
and
parent
material,
greatly
influences
decomposition
rates.
In
the
highly
fragmented
urban
landscape
land
history,
cover
and
management
will
strongly
influence,
and,
in
some
cases
may
override
these
drivers.</p>
		<br>
		<h2>What is GLUSEEN</h2>
		<p>
		Global
Urban
Soil
Ecological
Education
Network
(GLUSEEN)
is
an
open
source
ecological
network .
It
is
intended
to
be
a
worldwide
multi-city
comparison
investigating
the
effects
of
urban
environments
on
decomposition
and
soil
community
structure.</p><br>
<p>Questions
GLUSEEN
addresses</p>
		<ol>
		<li>1. Does
urbanization
create
novel
soil
ecosystems?
</li>
<li>2. Are
assembly
rules
of
urban
soil
communities
different?
</li>
<li>3. How
do
abiotic
drivers
differ
in
urban
ecosystems?</li>
<li>4. Do
these
ecosystem
converge
in
their
attributes
on
a
global
or
regional
scale?</li>
<li>5. GLUSEEN
develops
experimental
protocols
that
are
simple
to
adopt
across
many
habitat
types
and
soil
conditions
in
urban
areas
across
the
world.
Some
experiments
are
suitable
for
students
and
citizen
scientists.</li>

		</ol>
		<br>
		<!--
		<h2>Pilot
Study
and
Preliminary
Results</h2>
<p><b><u>Habitat Selection</u></b></p>
<p>Reference:
natural
vegetation
outside
the
city<br>
Remnant:
patches
of
reference
vegetation
within
the
city<br>
Low
maintenance
lawn:
residential
or
park<br>
Highly
disturbed:
construction
sites,
vacant
lots
Each
habitat
is
replicated
five
times</p>
		<p><b><u>Decomposition Experiments</u></b></p>
		<p>Lipton
pyramid
red
tea
was
used
as
a
unified
substrate <sup>4,5</sup>.
Teabags
were
presoaked
to
remove
soluble
material.
Teabags
are
picked
up
approximately
every
other
month.</p>
	<p><b><u>Soil
Characteristics</u></b></p>
<p><img src="http://10.55.17.52/mod/about/soil1.JPG" width="470" height="296"><img src="http://10.55.17.52/mod/about/soil2.JPG" width="470" height="296"></p>
<p><b><u>Soil Biota</u></b></p>
<p>Microbial
community:
Composition
and
quantity
of
fungi,
bacteria,
and
archaea
are
being
compared.
Fauna:
earthworms
will
be
sampled
and
identified
in
spring
2014.</p>
<p><b><u>Abiotic Factors</u></b></p>
<p>Soil
temperature
and
moisture
will
be
monitored.
Reference
data
will
be
harvested
from
databases.</p>
<h2>Acknowledgements</h2>
<p>The
initial
phase
of
GLUSEEN
is
being
supported
by
a
supplemental
grant
to
NSF-­‐ACI
1244820.
The
idea
for
GLUSEEN
was
made
possible
by
a
Fulbright
Specialist
grant
to
R.
Pouyat.
Thanks
to
students
and
colleagues
who
helped
in
the
field.</p>
<h2>Reference</h2>
<p>1. Craine
JM,
Bapersby
J,
Elmore
AJ,
and
Jones
AW
2007.
Building
EDENs:
The
rise
of
environmentally
distributed
ecological
networks.
BioScience
57:
45-­‐54.<br>
2. Henderson
S
2012.
Citizen
science
comes
of
age.
Fron
Ecol
Environ
10:
283.<br>
3. Pouyat
RV,
Szlavecz
K,
Yesilonis
ID,
et
al.
2010.
Chemical,
physical,
and
biological
characteristics
of
urban
soils.
In:
Aitkenhead-
Peterson
J
and
Volder
A
(Eds).
Urban
Ecosystem
Ecology
(Agronomy
Monograph
55),
pages
119-52.<br>
4. Keuskamp
JA,
Dingemans
BJJ,
Lehtinen
T,
et
al.
2013.
Tea
Bag
Index:
a
novel
approach
to
collect
uniform
decomposition
data
across
ecosystems.
Methods
Ecol
Evol
4:
1070-75.<br>
5. Wall
DH,
Bradford
MA,
John
MGS,
et
al.
JM
2008.
Global
decomposition
experiment
shows
soil
animal
impacts
on
decomposition
are
climate
dependent.
Global
Change
Biol
14:
2661-77.</p>-->
	',
        'filter' => '',
    );
	$body = elgg_view_layout('content', $params);

	echo elgg_view_page($params['title'], $body);
	return true;
}




