% knowledge.pro
%
% Knowledge based on Practical Traditional Chinese Medicine by
% Professor Xie Zhufan

%:- include('opdefs.pro').

citation(chim, [
	title:: `Clinical Handbook of Internal Medicine`,
	author:: `Will Maclean & Jane Lyttleton`,
	volume:: `1. Lung, Kidney, Liver, Heart`
	]).
citation(wnw, [
	title:: `The Treatment of Pain with Chinese Herbs and Acupuncture`,
	author:: `Sun Peilin, Shi Zhongan, Steven K. H. Aung, & Peter Deadman`
	]). 

initial_signs( [
	complaint,
	tongue_spirit,
	tongue_body,
	tongue_color,
	tongue_shape,
	tongue_move_state,
	tongue_coat,
	tongue_coat_color,
	tongue_coat_texture,
	tongue_coat_distribution ]).
initial_signs2( [
	pulse_contour,
	pulse_depth,
	pulse_force,
	pulse_length,
	pulse_rate,
	pulse_rhythm,
	pulse_tension,
	pulse_width
	]).

pattern(wind_cold, [
   indications::
	chills = lots and fever = mild and 
	(tongue_spirit = normal and (tongue_coat = thin and tongue_coat_color = white) ) and
	(pulse_depth = floating_pulse or (pulse_depth = floating_pulse and pulse_tension = tight_pulse) ),
   citation:: chim(4)
   ]).

% patterns for cough
% treatment for "wind cold" (fenghan kesuo) 风寒咳嗽 is to "expel wind & cold, redirect lung qi downward, stop cough":
%		classic formula "Canopy Powder" (Hua Gai San) 华盖散
diagnosis(wind_cold_cough, [
	indications::
  	   complaint = cough and stage = acute and
  	   pattern = wind_cold and
  	   occurrence = frequent and coughing_sound = loud and
	   (sputum_amount = moderate and sputum = (thin and watery) or sputum_color = (clear or white) ) and
	   (affected_head = (occipital or frontal) or affected_body = muscle) and
	   (sensation = stiffness and affected_head = neck) and sweat = no and
	   nasal = (obstruction or discharge) and 
	   respiratory = (dyspnea or wheezing),
	treatment:: wind_cold_cough-herbal,
	treatment:: wind_cold_cough-acupuncture,
	citation:: chim(74)
	]).
 
% treatment for "wind heat" (fengre kesuo) 风热咳嗽 is to "expel wind & clear heat, redirect lung qi downward, stop cough":
%		classic formula "Morus & Chrysanthemum Formula" (Sang Ju Yin) 桑菊饮
diagnosis(wind_heat, [
	indications::
	complaint = cough and stage = acute and
	coughing_sound = hacking and
	sputum_amount = none or (sputum_amount = little 
		and sputum = (dry or sticky) and sputum_color = yellow and sputum_expectorate = difficult) and
	fever = mild and chills = (no or mild) and
	nasal = (obstruction or discharge) and
	throat = (sore or dry or scratchy) and
	thirst and sweat = mild and
	affected_head = frontal and
	tongue_spirit = normal or 
		(tongue_color = red_tip and tongue_coat = thin and tongue_coat_color = (white or yellow)) and
	(pulse_depth = floating_pulse and pulse_rate = rapid_pulse),
	citation:: chim(77)
	]).

% treatment for wind and dryness (feng zhao kesuo) 风燥咳嗽:
%		"warm dryness" (wen zhao) 温燥: treatment is to "clear heat from the lungs, moisten dryness, redirect lung qi downward, stop cough":
%			classic formula "Morus & Apricot Seed Combination" (Sang Xing Tang) 桑杏汤	
diagnosis(warm_dryness, [
	indications::
	complaint = cough and stage = acute and
	coughing_sound = hacking and
	sputum_amount = none or 
			(sputum_amount = scanty and sputum = (thick or sticky or bloody) and sputum_expectorate = difficult) and
	(throat = dry or mouth = dry or lips = dry) and 
   (fever = mild or chills = mild) and
	(affected_head = head or affected_upper_body = chest) and
	tongue_spirit = normal or 
		(tongue_color = red_tip and tongue_coat = (thin or dry) and tongue_coat_color = yellow) and
	(pulse_width = fine_pulse or pulse_rate = rapid_pulse),
	citation:: chim(80)
	]).

% treatment for wind and dryness (feng zhao kesuo) 风燥咳嗽:
%		"cool dryness" (liang zhao) 凉燥：treatment is to "clear the lungs, moisten dryness, redirect lung qi downward, stop cough":
%			classic formula "Apricot Kernel & Perilla Leaf Powder" (Xing Su San) 杏苏散
diagnosis(cool_dryness, [
	indications::
	complaint = cough and stage = acute and
	sputum_amount = (none or little) and
	throat = (dry and (itchy or ticklish)) and
	lips = dry and nose = dry and
	affected_head = head and
	chills = mild and	fever = mild and sweat =  no and
	(tongue_coat = thin and tongue_coat_texture = dry and tongue_coat_color = white) and
	(pulse_depth = floating_pulse or pulse_tension = tight_pulse),
	citation:: chim(82)
	]).

% treatment for "lung heat" (feiri kesuo) 肺热咳嗽 is to "clear heat from the lungs, redirect lung qi downward, stop cough":
%		classic formula "Ephedra, Abricot Seed, Gypsum & Licorice Combination" (Ma Xing Shi Gan Tang) 麻杏石甘汤
% diagnosis(lung_heat) :- diagnosis().
diagnosis(lung_heat, [
	indications::
	complaint = cough and stage = acute and 
	coughing_sound = hacking and
	sputum_amount = none or (sputum_amount = little and sputum = (sticky or bloody) and
				sputum_expectorate = difficult) and
	fever = (high or mild) and
	(sensation = (tightness and heat) and location = chest) and
	complexion = red and	nose_color = red and
	dry = mouth and thirst and
	respiratory = (sob or wheezing) and
	(tongue_color = (red or red_tip) and tongue_coat_color = yellow) and
	((pulse_contour = surging_pulse or pulse_tension = wiry_pulse) and pulse_rate = rapid),
	citation:: chim(84)
	]).

% treatment for "phlegm damp" (tanshi kesuo) 痰湿咳嗽 is to "strengthen the spleen, dry damp, transform phlegm, stop cough":
%		classic formula "Citrus & Pinellia Combination" (Er Chen Tang) 二陈汤
diagnosis(phlegm_damp, [
	indications::
	complaint = cough and stage = chronic and
	(sputum_amount = profuse and sputum = (thin or thick) and sputum_color = clear) and
	worse = (morning and a_meal) and
	sensation = (fullness or stuffiness) and (affected_upper_body = chest or affected_lower_body = epigastrium) and 
	appetite = poor and
	sensation = nausea and vomit and stool = loose and
	energy = (lethargy or weakness) and
	(tongue_color = pale and tongue_shape = swollen) and 
		(tongue_coat_texture = (moist and greasy) and tongue_coat_color = white) and
	(pulse_force = soggy_pulse and pulse_contour = slippery_pulse),
	citation:: chim(87)
	]).

% treatment for "phlegm heat" (tanre kesuo) 痰热咳嗽 is to "expel phlegm & clear heat, redirect lung qi downward, stop cough"：
%		classic formula "Clear Metal, Transform Phlegm Decoction" (Qing Jin Hua Tan Tang) 清金化痰汤
diagnosis(phlegm_heat, [
	indications::
	complaint = cough and
	coughing_sound = hacking and
	(sputum_amount = profuse and sputum = (thick or bloody) and 
					sputum_color = (yellow or green) and sputum_expectorate = difficult) and
	chest = (fullness or stuffiness) and
	epigastrium = (fullness or stuffiness) and
	(respiratory = wheezing and worse = (night or morning)) and
	appetite = poor and sensation = nausea and
	stool = loose and defecate = constipation and
	energy = (lethargy or weak) and
	throat = (sore or congested) and taste = bitter and
	(tongue_coat = thick and tongue_coat_texture = greasy and tongue_coat_color = yellow) and
	((pulse_force = soggy_pulse or pulse_contour = slippery_pulse) and pulse_rate = rapid_pulse),
	citation:: chim(90)
	]).
	
% treatment for "liver fire invading the lungs" (ganhuo fan fei kesuo) 肝火犯肺咳嗽 is to "clear liver fire, moisten the lungs and transform phlegm":
%		classic formulas "Indigo & Conch Powder" (Dai Ge San) 黛蛤散 & "Mulberry Leaf & Moutan Decoction to Drain the White" (桑丹泻白汤)
diagnosis(liver_fire_invading_lungs, [
	indications::
	complaint = cough and stage = (acute or chronic) and
	sputum_amount = none or (sputum_amount = scatty and sputum = bloody) and 
	affected_uppper_body = chest and affected_lower_body = hypochondrium and
	aggravate = (stress or turmoil or anger) and
	feel = hot and emotion = upset and
	complexion = (red or flushed) and (affected_head = eye and pain = soreness and eye_color = red) and
	taste = bitter and thirst = very and
	(tension = hypochondrium or discomfort = hypochondrium) and
	(affected_head = head or sensation = dizziness) and 
	(tongue_color = red and tongue_coat = dry and (thin or thick) and tongue_coat_color = yellow) and
	((pulse_tension = wiry_pulse or pulse_contour = slippery_pulse) and pulse_rate = rapid_pulse),
	citation:: chim(93)
	]).

% treatment for "lung yin deficiency" (feiyin buzhu kesuo) 肺阴不足咳嗽 is to "nourish lung yin to stop cough, moisten the lungs, transform phlegm":
% 		classic formulas "Lily Combination" (Bai He Gu Jin Tang) 百合固金汤  & "Moonlight Pill" (Yue Hua Wan) 月华丸
diagnosis(lung_yin_deficiency, [
	indications::
	complaint = cough and stage = chronic and
	sputum_amount = none or (sputum_amount = little and sputum = (sticky or bloody) and sputum_expectorate = difficult) and
	dry = (mouth or throat) and
	(fever = mild and (time_occur = afternoon or evening)) and
	complexion = flushed and
	(sweat and time_occur = night) and
	energy = fatique and 
	tongue_color = red and tongue_coat = (none or little or dry or peeled) and
	(pulse_width = fine_pulse and pulse_rate = rapid_pulse),
	citation:: chim(96)
	]).

% treatment for "lung qi deficiency" (feiqi xu kesuo) 肺气虚咳嗽 is to "tonify lung qi, calm cough, transform thin mucus"：
%		classic formula "Tonify the Lungs Decoction" (Bu Fei Tang) 补肺汤
diagnosis(lung_qi_deficiency, [
	indications::
	complaint = cough and stage = chronic and
	sputum_amount = none or (sputum_amount = little and sputum = thin and sputum_color = (clear or white)) and
	respiratory = sob and sweat = spontaneous and
	temperature = cold and (voice = weak or speech = reluctance) and
	energy = fatigue and
	(tongue_color = pale and tongue_coat = thin and tongue_coat_color = white) and
	(pulse_width = fine_pulse and pulse_rate = rapid_pulse),
	citation:: chim(100)
	]).

% treatment for "spleen & kidney yang deficiency" (shen pi yang xu kesuo) 肾脾阳虚咳嗽 is to "warm yang, disperse cold, transform qi to move fluids":
%		classic formula "True Warrior Decoction" (Zhen Wu Tang) 真武汤 
diagnosis(spleen_kidney_yang_deficiency, [
	indications::
	complaint = cough and stage = chronic and
	(sputum = thin and sputum_color = watery) and
	respiratory = (wheezing and dyspnea) and
	worse = exertion and oedema and 
	aversion = cold and heavy = limbs and
	sweat = spontaneous and urination = difficult and
	sensation = (dizziness and palpitation) and
	(tongue_shape = swollen and tongue_color = pale and tongue_coat = moist and tongue_coat_color = white) and
	(pulse_depth = sinking_pulse and pulse_contour = slippery_pulse),
	citation:: chim(103)
	]).

% treatment for "blood stagnatio" (xueyu kesuo) 血瘀咳嗽 is to "resolve stagnant blood in the lungs, stop cough": 
%		classic formula "Achyranyhes & Persica Combination" (Xue Fu Zhu Yu Tang) 血府逐瘀汤 			
diagnosis(blood_stagnation, [
	indications::
	complaint = cough and stage = (chronic or recurrent) and 
	sputum_amount = none or (sputum_amount = scatty and sputum = bloody) and
	injury = trauma and
	worse = night and
	(tongue_body = spotted and tongue_color = (pale or brown or purple)) and
	((pulse_tension = wiry_pulse or pulse_width = fine_pulse) and pulse_force = weak_pulse),
	citation:: chim(105)
	]).

% treatment for "pain in the entire body" 周身疼痛
diagnosis(wind_cold, [
	indications::
	complaint = pain and affected_body = body and
	stage = acute and 
	(pain = ache and affected_head = head) and
	(sensation = stiffness and affected_head = neck) and  
	(affected_body = back and affected_extremity = joint) and
	aversion = cold and
	fever and sweat = no and thirst = no and
	urine_color = clear and
	(tongue_color = pale and tongue_coat_color = white) and
	(pulse_depth = floating_pulse and pulse_tension = tight_pulse),
	citation:: tpcha(51)
	]).
	
/*  put this copy here to compare with above
% patterns for cough
% treatment for "wind cold" (fenghan kesuo) 风寒咳嗽 is to "expel wind & cold, redirect lung qi downward, stop cough":
%		classic formula "Canopy Powder" (Hua Gai San) 华盖散
diagnosis(wind_cold, [
	indications::
  	complaint = cough and stage = acute and
  	occurrence = frequent and coughing_sound = loud and
	(sputum_amount = moderate and sputum = (thin and watery) or sputum_color = (clear or white) ) and
	chills = lots and fever = mild and 
	(affected_head = (occipital or frontal) or affected_body = muscle) and
	(sensation = stiffness and affected_head = neck) and sweat = no and
	nasal = (obstruction or discharge) and 
	respiratory = (dyspnea or wheezing) and
	(tongue_spirit = normal and (tongue_coat = thin and tongue_coat_color = white) ) and
	(pulse_depth = floating_pulse or (pulse_depth = floating_pulse and pulse_tension = tight_pulse) ),
	citation:: chim(74)
	]).
*/

diagnosis(wind_damp, [
	indications::
	complaint = pain and (affected_body = body and pain_with = heaviness) and
	(pain = soreness and sensation = numbness and affected_body = muscle) and
	(pain = ache and affected_head = head) and
	(pain_with = swelling and affected_extremity = joint) and  
	fever = low and appetite = poor and thirst = no_drink and
	stool = (loose and sticky) and
	(tongue_coat_texture = sticky and tongue_coat_color = white) and
	(pulse_depth = sinking_pulse and pulse_contour = slippery_pulse),
	citation:: tpcha(52)
	]).
		
diagnosis(damp_heat, [
	indications::
	complaint = pain and stage = (acute or chronic) and 
	(affected_body = body and pain_with = swelling and pain_with = heaviness) and
	temperature = hot and
	aggravate = heat and
	ameliorate = cold and
	(pain = ache and affected_head = head) and
	(urine_amount = scanty and urine_color = yellow) and 
	defecate = constipation and
	fever and aversion = cold and
	thirst and taste = bitter and
	(tongue_color = red and tongue_coat = thick and tongue_coat_color = yellow) and
	(pulse_contour = slippery_pulse and pulse_rate = rapid_pulse),
	citation:: tpcha(53)
	]).

diagnosis(liver_qi_stagnation, [
	indications::
	complaint = pain and stage = chronic and 
	(affected_body = body and pain = distending) and
	aggravate = emotion and
	(pain = ache and affected_head = head) and
	(pain = dull and affected_internal = stomach) and
	(affected_lower_body = lower_abdomen) and
	sensation = dizziness and 
	sleep = insomnia and
	feelings = (irritability and palpitation) and
	appetite = poor and
	(tongue_color = red and tongue_coat_color = white) and
	(pulse_tension = wiry_pulse),
	citation:: tpcha(54)
	]).
	
diagnosis(blood_stagnation, [
	indications::
	complaint = pain and  
	(affected_body = body and pain_with = fixed_location and pain = sharp and pain = stabbing) and
	thirst = no_drink and time_occur = night and
	(tongue_color = purple and tongue_coat_color = white) and
	(pulse_contour = choppy_pulse and pulse_depth = sinking_pulse),
	citation:: tpcha(56)
	]).     

diagnosis(qi_blood_deficiency, [
	indications::
	complaint = pain and stage = chronic and 
	(affected_body = body and pain = soreness and affected_body = muscle) and
	energy = fatigue and respiratory = sob and sensation = dizziness and 
	appetite = poor and sweat = spontaneous and aversion = wind and
	complexion = pale and stool = loose and defecate = diarrhoea and
	(tongue_color = pale and tongue_coat_color = white) and
	(pulse_force = weak_pulse and pulse_width = fine_pulse),
	citation:: tpcha(57)
	]).

diagnosis(kidney_yin_deficiency, [
	indications::
	complaint = pain and stage = chronic and
	affected_body = body and temperature = hot and
	fever = mild and sweating and time_occur = night and 
	mouth = dry and thirst and appetite = poor and ear = tinnitus and
	(pain = soreness and affected_lower_body = lower_back) and
	feelings = restlessness and sleep = insomnia and
	energy = lassitude and defecate = constipation and
	(tongue_color = red and tongue_coat = (none or thin)) and
	(pulse_width = fine_pulse and pulse_rate = rapid_pulse),
	citation:: tpcha(58)
	]).  
	
diagnosis(kidney_yang_deficiency, [
	indications::
	complaint = pain and (stage = chronic or constitution = weak) and 
	(affected_body = body and temperature = cold and energy = lassitude) and
	aversion = cold and 
	(temperature = cold and affected_extremity = limb) and complexion = pale and 
	(urination = frequent and time_occur = night) and
	(pain = soreness and affected_lower_body = lower_back) and
	(tongue_color = pale and tongue_coat_color = white) and
	(pulse_depth = sinking_pulse and pulse_width = fine_pulse),
	citation:: tpcha(59)
	]).