<?php
/*
Template Name: compound
*/
if(get_post_meta($post->ID, "has-prefooter")){
$prefooter_class = "has-prefooter";
}else{
	$prefooter_class = "";
}


get_header(); ?>

<?php get_template_part( 'parts/featured-image' ); ?>

<div class="row full-page-top <?php echo $prefooter_class; ?>" ng-app="compound" ng-controller="compoundController">
	<?php /* Start loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
	<div class="small-12 large-12 columns" role="main">

		<div class="entry-content">
			<div class="row">
				<div class="column small-12 medium-8">
					<?php the_content(); ?>
				</div>
			</div>
			
			<div class="row">
				<div class="column small-12 medium-11 medium-centered">
					<table class="compoundCompatibility">
						<thead>
							<tr>
								<th><a href="" ng-click="sortType='drugName'; sortReverse = !sortReverse">Drug Name</a> <i class="fa" ng-class="sortReverse ? 'fa-caret-down' : 'fa-caret-up'"></i></th>
								<th><a href="" ng-click="sortType='membrane'; sortReverse = !sortReverse">Membrane</a> <i class="fa" ng-class="sortReverse ? 'fa-caret-down' : 'fa-caret-up'"></i></th>
								<th><a href="" ng-click="sortType='poreSize'; sortReverse = !sortReverse">Pore Size</a> <i class="fa" ng-class="sortReverse ? 'fa-caret-down' : 'fa-caret-up'"></i></th>
								<th class="hide-for-small-only"><a href="" ng-click="sortType='capColor'; sortReverse = !sortReverse">Cap Color</a> <i class="fa" ng-class="sortReverse ? 'fa-caret-down' : 'fa-caret-up'"></i></th>
								<th>Cross Referance Article</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="d in compounds | orderBy:sortType:sortReverse">
								<td>{{ d.drugName }}</td>
								<td>{{ d.membrane }}</td>
								<td>{{ d.poreSize }}&mu;m</td>
								<td class="hide-for-small-only" style="text-align:center;"><i class="fa fa-circle" style="color:{{d.capColor}};"></i></td>
								<td><a class="referanceLink" href="#{{r}}" ng-repeat="r in d.referance">{{ r }}</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			<div class="row">
			<div class="referances column small-12 medium-11 medium-centered panel callout radius">
				<a name="1"></a>
				<h3>References</h3>
			
				<ol>
					<a name="2"></a>
					<li>Santini, A. O. <em>et al.</em> (2004). p-Aminobenzoate ion determination in pharmaceutical formulations by using a potentiometric sensor immobilized in a graphite matrix. <em>Talanta</em> <strong>63</strong>:833-838.</li>
			
					<a name="3"></a>
					<li>Bosanquet, A.G. (1985) Stability of solutions of antineoplastic agents during preparation and storage for <em>in vitro </em>assays. General considerations, the nitrosoureas and alkylating agents. <em>Cancer Chemother. Pharmacol</em>.<em> </em><strong>14</strong>:83-95</li>
			
					<a name="4"></a>
					<li>Capello, B. <em>et al</em>. (2001) Solubilization of tropicamide by hydroxypropyl-[beta]-cyclodextrin and water-soluable polymers: <em>in vitro/in vivo</em> studies. <em>Int. J. Pharm.</em><strong>213</strong>:75-81.</li>
			
					<a name="5"></a>
					<li>Butler, L.D., <em>et al</em> (1980). Effect of inline filtration on the potency of low-dose drugs. <em>Am. J. Hosp. Pharm</em>. <strong>37</strong>:935-941.</li>
			
					<a name="6"></a>
					<li>Chang, C.W., <em>et al.</em>(2007). A robotic synthesis of [18F]fluoromisonidazole([18F]FMISO), <em>Applied Radiation and Isotopes</em>, In Press, Accepted Manuscript, Available online 6 February.</li>
			
					<a name="7"></a>
					<li>Fagny, C., <em>et al</em>. (2002). Ribonucleotide reductase and thymidine phosphorylation: two potential targets of azodicarbonamide. <em>Biochem. Pharmacol</em>.<strong> 64</strong>: 451-456.</li>
			
					<a name="8"></a>
					<li>
						<kiesewetter, <em="">et al. (2003). Fluoro-, bromo-, iodopaclitaxel derivatives: synthesis and biological evaluation. <em>Nuclear Medicine and Biology</em>. <strong>30</strong>: 11-24.</kiesewetter,>
					</li>
			
					<a name="9"></a>
					<li>Elenbaas, J.K., <em>et al</em>. (1985). Effect of inline filtration on tobramycin delivery. <em>Drug Intell. Clin. Pharm</em>. <strong>19</strong>: 122-125.</li>
			
					<a name="10"></a>
					<li>Ennis, C.E., <em>et al.</em> (1983) <em>In vitro</em> study of inline filtration of medications commonly administered to pediatric cancer patients. <em>J. Parenter Enter.Nutr</em>. <strong>7</strong>: 156-158.</li>
			
					<a name="11"></a>
					<li>Lallemand, <em>et. al</em>. (2005) A novel water-soluble cyclosporine A prodrug: Ocular tolerance and <em>in vivo</em> kinetics. <em>Int.J.Pharm</em>. <strong>295</strong>: 7-14.</li>
			
					<a name="12"></a>
					<li>Verreck, G., <em>et al.</em> (2005). Preparation and physicochemical characterization of biodegradable nerve guides containing the nerve growth agent sabeluzole. <em>Biomaterials</em> <strong>26</strong>: 1307-1315.</li>
			
					<a name="13"></a>
					<li>Flaten, G.E., <em>et al</em>. (2006) Drug permeability across a phospholipid vesicle based barrier. A novel approach for studying passive diffusion. <em>European Journal of Pharmaceutical Science</em>s <strong>27</strong>: 80-90.</li>
			
					<a name="14"></a>
					<li>Grant, A.M.(1987). Personal communication.</li>
			
					<a name="15"></a>
					<li>Huber, R.C. and Riffkin, C. (1975) Inline final filters for removing particles from amphotericin B infusions. <em>Am.J.Hosp.Pharm.</em> <strong>32</strong>: 173-176.</li>
			
					<a name="16"></a>
					<li>Toro, I. <em>et al</em>. (2004). Development and validation of a capillary electrophoresis method with ultraviolet detection for the determination of the related substances in a pharmaceutical compound. <em>J. Chromatogr.</em> <em>A</em> <strong>1043</strong>:
						303-315</li>
			
					<a name="17"></a>
					<li>Calleja, I. <em>et al</em>. (2004). High–performance liquid-chromatographic determination of rifampicin in plasma and tissues. <em>J.</em> <em>Chromatogr</em>. <strong>1031</strong>: 289-294.</li>
			
					<a name="18"></a>
					<li>Gennaro, M.C., <em>et al.</em> (2001) Ion interaction reagent reversed-phase high-performance liquid chromatography determination of anti-tuberculosis drugs and metabolites in biological fluids. <em>J. Chromatogr</em>. <em>B</em> <strong>754</strong>:
						477-486.</li>
			
					<a name="19"></a>
					<li>Kanke, M., <em>et al</em>. (1983). Binding of selected drugs to a “treated” inline filter. <em>Am</em>. <em>J. Hosp.Pharm</em>. <strong>40</strong>: 1323-1328.</li>
			
					<a name="20"></a>
					<li>Khue, N. V., and Jung, L. (1985). Study of the retention of child-dose drugs on cellulose ester membranes during inline intravenous filtration. <em>S-T-P Pharma</em>. <strong>1</strong>: 201-207.</li>
			
					<a name="21"></a>
					<li>Boca, M.B., <em>et al</em>. (2005), A validated HPLC method for determining residues of a dual active ingredient anti-malarial drug on manufacturing equipment surfaces. <em>J. Pharm. Biomed.Anal. </em><strong>37</strong>:461-468.</li>
			
					<a name="22"></a>
					<li>Maddus, M.S. , and Barrierre, S.L. (1980). A review of complications of amphotericin B therapy; recommendations for prevention and management. <em>Drug Intell. Clin. Pharm.</em> <strong>14</strong>: 177-181.</li>
			
					<a name="23"></a>
					<li>Ines, M., <em>et al.</em> (2006). Quantitative determination of gatifloxacin, levofloxacin, lomefloxacin and pefloxacin fluoroquinolonic antibodies in pharmaceutical preparations by high-performance liquid chromatography. <em>J. Pharm.Biomed.Anal.</em>			<strong>40</strong>: 179-184.</li>
			
					<a name="24"></a>
					<li>Fantin, M., <em>et al</em>. (2006). Pentoxifylline and its major oxidative metabolites exhibit different pharmacological properties. <em>European Journal of Pharmacology</em> <strong>535</strong>: 301-309.</li>
			
					<a name="25"></a>
					<li>McEvoy, G. K. (Ed.) . (1991) American hospital formulary service drug information 91. <em>American Society of Hospital Pharmacists.</em></li>
			
					<a name="26"></a>
					<li>Ober, M.D. <em>et al</em>. (2006), Measurement of the Actual Dose of Triamcinolone Acetonide Delivered by Common Techniques of Intravitreal Injection<em>. American Journal of Ophthalmology</em> <strong>142</strong>: 597-600.e1.</li>
			
					<a name="27"></a>
					<li>Lofwall, M. R. ,<em>et al</em>. (2006). Cognitive and Subjective Acute Dose Effects of Intramuscular Ketamine in Healthy Adults. <em>Experimental and Clinical Psychopharmacology</em> <strong>14</strong>: 439-449.</li>
			
					<a name="28"></a>
					<li>Kato, M., <em>et al.</em> (2005) Examination of meningocele induced by the antitumor agent DE-310 in rat fetuses. <em>Reproductive Toxicology</em> <strong>20</strong>: 495-502.28. <em>Miles Pharm.</em></li>
			
					<a name="29"></a>
					<li>Langer, O., <em>et al.</em> (2003). Synthesis of fluorine-18-labeled ciprofloxacin for PET studies in humans. <em>Nuclear Medicine and Biology</em> <strong>30</strong>: 285-291.</li>
			
					<a name="30"></a>
					<li>Pavlik, E. J., <em>et al</em>. (198e). Properties of anticancer agents relevant to <em>in vitro</em> determinations of human tumor cell sensitivity. <em>Cancer Chemother. Pharmacol</em>. <strong>11</strong>: 8-15.</li>
			
					<a name="31"></a>
					<li>Pavlik, E.J., <em>et al</em>. (1982) Sensitivity to anticancer agents <em>in vitro</em>: standardizing the cytotoxic response and characterizing the sensitivities of a reference cell line. <em>Gynecol. Oncol</em>. <strong>14</strong>: 243-261.</li>
			
					<a name="32"></a>
					<li>Oradell, N.J., 1991). <em>Physicians’ Desk Reference</em>. 45<sup>th</sup> edition.</li>
			
					<a name="33"></a>
					<li>Rusmin, S., <em>et al.</em> (1977). Effect of inline filtration on the potency of drugs administered intravenously. <em>Am.J. Hosp. Pharm</em>. <strong>34</strong>: 1071-1074.</li>
			
					<a name="34"></a>
					<li>Rudaz, S., <em>et al</em>. (2003). Veuthey, Development and validation of a heart-cutting liquid chromatography-mass spectrometry method for the determination of process-related substances in cetirizine tablets. <em>Analytica Chimica Acta</em> <strong>492</strong>:
						271-282.</li>
			
					<a name="35"></a>
					<li>Fazio, T.T., <em>et al.</em> (2007) Quantitative determination and sampling of azathioprine residues for cleaning validation in production area. <em>J. Pharm. Biomed,Anal.</em> <strong>43</strong>: 1495-1498.</li>
			
					<a name="36"></a>
					<li>Thompson, D. F., <em>et al</em>. (1984). Effect of inline filtration on pediatric doses of gentamicin and tobramycin. <em>Infusion</em> <strong>8</strong>: 31-32.</li>
			
					<li>Tipple, M. <em>et al.</em> (1977). Availability of active amphotericin B after filtration through membrane filters. <em>Am. Rev. Resp.Dis</em> <strong>115</strong>: 879-881.</li>
				</ol>
			</div>
			</div>
			
			
			
		</div>

	<?php endwhile; // End the loop ?>

	</div>
		</article>
</div>

<?php get_footer(); ?>
