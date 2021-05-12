:- module(english).

% this is included to illustrate how to code more complex messages with
% variables in their input.

% pulse section
% 	pulse qualities
text(big_pulse, `big`).								% 大脉
text(choppy_pulse, `choppy`).						% 涩脉 - rough
text(empty_pulse, `empty`).						% 虚脉 - deplete, weak, deficiency
text(fine_pulse, `fine`).							% 细脉 - thin, thready, small, minute
text(firm_pulse, `firm`).							% 牢脉
text(floating_pulse, `floating`). 				% 浮脉
text(full_pulse, `full`).							% 实脉 - replete, excess, strong
text(knotted_pulse, `knotted`).					% 结脉 - bound, hesitant, nodular, adherent
text(hidden_pulse, `hidden`).						% 伏脉
text(hollow_pulse, `hollow`).						% 芤脉 - scallion stalk
text(intermittent_pulse, `intermittent`).		% 代脉 - interrupted
text(leather_pulse, `leather`).					% 革脉 - drumskin, tympanic
text(long_pulse, `long`).							% 长脉
text(minute_pulse, `minute`).						% 微脉 - feeble, faint
text(moderate_pulse, `moderate`).				% 缓脉 - retarded
text(moving_pulse, `moving`).						% 动脉 - stirred, spinning bean, shaking, throbbing
text(racing_pulse, `hurried`).					% 疾脉 - swift
text(rapid_pulse, `rapid`).						% 数脉
text(scattered_pulse, `scattered`).				% 散脉
text(short_pulse, `short`).						% 短脉
text(sinking_pulse, `sinking`).					% 沉脉 - sunken, submerged
text(skipping_pulse, `skipping`).				% 促脉 - hasty, abrupt, hurried, running
text(slippery_pulse, `slippery`).				% 滑脉
text(slow_pulse, `slow`).							% 迟脉	
text(soggy_pulse, `soggy`).						% 濡脉 - soft, weak, frail
text(surging_pulse, `surging`).					% 洪脉 - overflowing, flooding
text(tight_pulse, `tight`).						% 紧脉 - tense or squeezed
text(weak_pulse, `weak`).							% 弱脉 - frail
text(wiry_pulse, `wiry`).							% 弦脉 - stringlike, taut
% 	end of pulse qualities

% 	Pulse prompts
text(pulse_contour, `contour of pulse`).
text(pulse_contour-prompt, `Pulse (contour):`).
text(pulse_depth, `depth of pulse`).
text(pulse_depth-prompt, `Pulse (depth):`).
text(pulse_force, `force of pulse`).
text(pulse_force-prompt, `Pulse (force):`).
text(pulse_length, `length of pulse`).
text(pulse_length-prompt, `Pulse (length):`).
text(pulse_rate, `rate of pulse`).
text(pulse_rate-prompt, `Pulse (rate):`).
text(pulse_rhythm, `rhythm of pulse`).
text(pulse_rhythm-prompt, `Pulse (rhythm):`).
text(pulse_tension, `tension of pulse`).
text(pulse_tension-prompt, `Pulse (tension):`).
text(pulse_width, `width of pulse`).	
text(pulse_width-prompt, `Pulse (width):`).
% 	end of pulse prompts

% end of pulse section

% diagnosis section
%	patterns
text(blood_stagnation, `Blood Stagnation`).
text(cool_dryness, `Invasion of Wind & Cool Dryness`).
text(damp_heat, `Invasion of Damp Heat`).
text(kidney_yang_deficiency, `Kidney Yang Deficiency`).
text(kidney_yin_deficiency, `Kidney Yin Deficiency`).
text(liver_fire_invading_lungs, `Liver Fire Invading Lungs`).
text(liver_qi_stagnation, `Liver Qi Stagnation`).
text(lung_heat, `Lung Heat`).
text(lung_qi_deficiency, `Lung Qi Deficiency`).
text(lung_yin_deficiency, `Lung Yin Deficiency`).
text(phlegm_damp, `Phlegm Damp`).
text(phlegm_heat, `Phlegm Heat`).
text(qi_blood_deficiency, `Qi and Blood Deficiency`).
text(spleen_kidney_yang_deficiency, `Spleen and Kidney Yang Deficiency`).
text(warm_dryness, `Invasion of Wind & Warm Dryness`).
text(wind_cold, `Invasion of Wind Cold`).
text(wind_damp, `Invasion of Wind Damp`).
text(wind_heat, `Invasion of Wind Heat`).
%	end of patterns

% end of diagnosis

text(ache, `ache`).
text(acrid, `acrid`).
text(acute, `acute`).
text(after_meal, `after a meal`).
text(afternoon, `in the afternoon`).
text(aggravate, `aggravate`).
text(aggravate-prompt, `The problem is aggravated by:`).
text(ameliorate, `ameliorate`).
text(ameliorate-prompt, `The problem could be ameliorated by:`).
text(anger, `anger`).
text(angry, `angry`).
text(appetite, `appetite`).
text(appetite-prompt, `How is the patient's appetite?`).
text(aversion, `aversion`).
text(aversion-prompt, `Is patient aversion to:`).
text(axillae, `axillae`).

text(back, `back`).
text(barking, `barking`).
text(before_meal, `before a meal`).
text(big, `big`).
text(bitter, `bitter`). 
text(black, `black`).
text(bleak, `bleak`).
text(blend, `blend`).
text(bloody,`bloody`).
text(blue, `blue`).
text(bottom_body, `bottom half of the body`).
text(body, `on the entire body`).
text(boring, `boring`).
text(bowel_movement, `bowel movement`).
text(breath, `breathing`).
text(breath-prompt, `How is the patient breathing?`).
text(brown, `brown`).						% 褐色
text(bruise, `bruise`).						% 碰伤
text(burning, `burning`).

text(center, `center`).
text(chest, `chest`).
text(chills, `chills`).
text(chills-prompt, `Does the patient have chills?`).
text(chronic, `chronic`).
text(clear, `clear`).
text(cold, `cold`).
text(cold_drink, `cold drink`).
text(colicky, `colicky`).
text(complaint, `Complaint`).
text(complaint-prompt, `What is the main complaint?`).
text(complexion, `face color`).				% 脸色
text(complexion-prompt, `What is the color of the patient's face?`).
text(congested, `congested`).					% 拥塞
text(constipation, `constipation`).			% 便秘
text(constitution, `constitution`).			% 体质
text(cough, `cough`).							% 咳嗽
text(coughing_sound, `coughing sound`).	% 咳嗽声
text(coughing_sound-prompt, `How does the cough sound?`).
text(craving, `craving`).						% 渴望
text(crimson, `crimson`).						% 绛
text(crying, `crying`).							% 哭
text(curdy, `curdy`).							% 腐腻
text(cutting, `cutting`).

text(dark, `dark`).
text(dark_very, `very dark`). 
text(dark_yellow, `dark yellow`).
text(delirious, `delirious`).
text(day, `during the day`).
text(deep, `deep`).
text(defecate, `defecate`).
text(depression, `depression`).
text(deviated, `deviated`).
text(diarrhoea, `diarrhoea`).
text(difficult, `difficult`).
text(discharge, `discharge`).
text(discharge_color, `discharge color`).
text(discomfort, `discomfort`).
text(discomfort-prompt, `Areas of discomfort:`).
text(dislike, `dislike`).
text(distending, `distending`).
text(distressing, `distressing`).
text(dizziness, `dizziness`).
text(double_tongue, `double`).
text(dry, `dry`).
text(dry-prompt, `Parts of the body feel dry:`).
text(dyspnea, `dyspnea`).
 
text(easy, `easy`).
text(eating, `eating`).
text(emptiness, `emptiness`).
text(emotion, `emotion`).
text(emotion-prompt, `What are the patient's emotions.`).
text(energy-prompt, `What is the patient's level energy`).
text(epigastrium, `epigastrium`).
text(evening, `in the evening`).
text(exertion, `on exertion`).
text(exfoliative, `exfoliative`).

text(error_missing_ask(Attr), Msg) :-
   get_text(Attr, AttrText),
	stringlist_concat([`There is no way to find a value for:`, AttrText], ` `, Msg).

text(face, `in the face`).
text(fat, `fat`).
text(feeble, `feeble`).
text(feelings, `feel`).
text(feelings-prompt, `How does the patient feel?`).
text(feet, `feet`).
text(fever, `fever`).
text(fever-prompt, `Does the patient have fever?`).
text(fine, `fine`).
text(fissured, `fissured`).
text(flaccid, `flaccid`).
text(frequent, `frequent`).
text(frontal, `frontal`).
text(full, `full`).
text(fullness, `fullness`).
text(fullness-prompt, `Areas of feeling fullness:`).

text(good, `good`).
text(green, `green`). 
text(greasy, `greasy`).
text(grey, `grey`).
text(groaning, `groaning`).

text(hacking, `hacking`).
text(hands, `hands`).
text(happy, `happy`).
text(hasty, `hasty`).
text(head, `head`).
text(headache, `headache`).
text(heat, `heat`).
text(heaviness, `heaviness`).
text(heavy, `heavy`).
text(heavy-prompt, `Parts of the body feel heavy:`).
text(hemialgia, `hemialgia`).
text(hesitation, `hesitation`). 
text(hoarse, `hoarse`).
text(hollow, `hollow`).
text(hot_drink, `hot drink`).
text(huanmai, `moderate`).
text(hungery, `hungery`).
text(hurried, `hurried (swift)`).
text(hypochondria, `hypochondria`).

text(incoherent, `incoherent`).
text(injury, `injury`).
text(injury, `What type of injury did the patient experience?`).
text(insomnia, `insomnia`).
text(irritability, `irritability`).
text(itchy,`itchy`).

text(joint, `joints`).							% 关节

text(laughing, `laughing`).
text(legs, `in the legs`).
text(light, `light`).
text(limb, `limbs`).
text(little, `a little of`). 
text(lips, `lips`).
text(location, `location`).
text(location-prompt, `Where is the problem located?`).
text(long, `long`).
text(long_thin, `long and thin`).
text(loose, `loose`).
text(lots, `a lot of`).
text(loud, `loud`).
text(lower_abdomen, `lower abdomen`).		% 下腹
text(lower_back, `lower back`).				% 下背
text(lurking, `lurking`).
text(lustrous, `lustrous`).  

text(menu_choice, `Enter the number(s) of choice(s) separated by commas: `).
text(mild, `mild`).
text(moist, `moist`).
text(morning, `in the morning`).
text(mouth, `mouth`).
text(moving, `moving`).
text(mouldy, `mouldy`).
text(mucus, `mucus`).
text(muffled, `muffled`).
text(muscle, `muscle`).
text(muttering, `muttering to oneself`).

text(nasal, `nasal`).
text(nasal-prompt, `Does the patient's nasal have:`).
text(nausea, `nausea`).
text(neck, `neck`).
text(night, `at night`).
text(no, `no`).
text(no_drink, `no desire to drink`).
text(none, `none`).
text(normal, `normal`).
text(nose, `nose`).
text(nose_color, `color of the nose`).
text(not_often, `not so often`).
text(numbness, `numbness`).

text(obstruction, `obstruction`).
text(occipital, `occipital`).
text(occurrence, `how frequent`).
text(occurrence-prompt, `How frequent?`).
text(oedema, `oedema`).
text(oedema-prompt, `Where is the oedema located?`).

text(pain, `pain`).
text(pain-prompt, `Describe the type of pain:`).
text(pale, `pale`).
text(palm, `palms`).
text(palpitation, `heart palpitation`).
text(pantalgia, `pantalgia`).
text(partial, `partial`).
text(peeled, `peeled (mirror tongue)`).
text(pellets, `pellets`).
text(persistent, `persistent`).
text(pink, `pink`). 
text(poor, `poor`).
text(profuse, `profuse`).
text(protruding, `protruding`).
text(pressure, `pressure`).
text(pulling, `pulling`).
text(pulse, `pulse`).
text(pulse-prompt, `Select the qualities of the patient's pulses?`).
text(pungent, `pungent`).
text(purple, `purple`).
text(pushing, `pushing`).
text(putrid, `putrid`).

text(quick_temper, `quick temper`).
text(quivering, `quivering`).

text(rattling, `rattling`).
text(rebellious, `rebellious qi`).
text(red, `red`).
text(red_tip, `red tip`).
text(respiratory, `respiratory`).
text(reluctance, `reluctance`).
text(respiratory-prompt, `How is the patient's respiratory?`).
text(rest, `rest`).
text(restlessness, `restlessness`).
text(root, `root`).
text(retracted, `retracted`).
text(rough, `rough`).

text(sad, `sad`).
text(salty, `salty`).
text(scanty, `scanty`).
text(scratchy, `scratchy`).
text(sensation, `sensation`).
text(sensation-prompt, `What are the patient's sensations? `).
text(sharp, `sharp`).
text(short, `short`).
text(sides, `sides`).
text(sigh, `sighing`).
text(site, `site where the problem occur`).
text(site-prompt, `Select the site of problem?`).
text(sleep, `sleeping`).
text(slippery, `slippery`).
text(slow, `slow`).
text(slurred, `slurred`).
text(small, `small`).
text(sob, `shortness of breath`).
text(snow, `snow`).
text(soft, `soft`).
text(sole, `soles`).
text(sore, `sore`).
text(soreness, `soreness`).
text(sour, `sour`).
text(spastic, `spastic`).
text(speech, `speech`).
text(speech-prompt, `How does the patient's speech?`).
text(spotted, `spotted`).
text(spontaneous, `spontaneous`).
text(sputum, `sputum`).
text(sputum-prompt, `Select the quality of the sputum:`).
text(sputum_color, `color of sputum`).
text(sputum_color-prompt, `What is the color of the sputum?`).
text(sputum_amount, `amount of sputum`).
text(sputum_amount-prompt, `What is the amount of the sputum?`).
text(sputum_expectorate, `expectorate sputum`).
text(sputum_expectorate-prompt, `Is sputum easy or difficult to expectorate?`).
text(stabbing, `stabbing`).
text(stage, `stage`).
text(stage-prompt, `What is the stage of the disease?`).
text(sticky, `sticky`).
text(stiff, `stiff`).
text(stiffness, `stiffness`).
text(stiffness-prompt, `Areas of having stiffness:`).
text(stomach, `in the stomach`).
text(stool, `stool`).
text(stool-prompt, `What is the quality of the stools?`).
text(stool_color, `stool color`).
text(stool_color-prompt, `What is the color of the stools?`).
text(stool_shape, `stool shape`).
text(stool_shape-prompt, `What is the shape of the stools?`).
text(stress, `stress`).
text(stressful, `stressful`).
text(strong, `strong`).
text(stuffiness, `stuffiness`).
text(stuffiness-prompt, `Areas of feeling stuffiness:`).
text(stuttering, `stuttering`).
text(sweat, `sweat`).
text(sweat-prompt, `How much does the patient sweat?`).
text(sweat_area, `areas of sweating`).
text(sweat_area-prompt, `Where are areas of sweating?`).
text(sweet, `sweet`).
text(swelling, `swelling`).
text(swollen, `swollen`).
text(symptom, `symptom`).
text(symptom-prompt, `Does patient have the following symptoms?`).

% treatment principles
% cough

text(Diagnosis-Method, Text) :-
   Method \= prompt,
   language(L),
   get_text(Diagnosis, DiagTxt),
   get_text(Method, MethTxt),
   stringlist_concat([
      `<a href=%22http%3a%2f%2fwww.amzi.com%2ftcm%2ftreatment.php%3flanguage=`, L,
      `%26treatment=`, Method,
      `%26diagnosis=`, Diagnosis, `%22>`, MethTxt, ` - `, DiagTxt, `<%2fa>`], ``, Text).

/* write a converted function
Reserved characters after percent-encoding
 !   *   '   (   )   ;   :   @   &   =   +   $   ,   /   ?   #   [   ] 
%21 %2A %27 %28 %29 %3B %3A %40 %26 %3D %2B %24 %2C %2F %3F %23 %5B %5D 
*/

text(blood_stagnation_cough-treatment, `Treatment principle for BLOOD STAGNATION cough: resolve stagnant Blood in the Lungs, stop cough.`).
text(cool_dryness_cough-treatment, `Treatment principle for COOL DRYNESS cough: clear the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(liver_fire_invading_lungs_cough-treatment, `Treatment principle for LIVER FIRE INVADING THE LUNGS cough: clear Liver Fire, Moisten the Lungs and transform Phlegm.`).
text(lung_heat_cough-treatment, `Treatment principle for LUNG HEAT cough: clear Heat from the Lungs; redirect Lung qi downward, stop cough; transform Phlegm.`).
text(lung_qi_deficiency_cough-treatment, `Treatment principle for LUNG QI DEFICIENCY cough: tonify Lung qi, calm cough; transform thin mucus.`).
text(lung_yin_deficiency_cough-treatment, `Treatment principle for LUNG YIN DEFICIENCY cough: nourish Lung yin to stop cough; Moisten the Lungs, transform Phlegm.`).
text(phlegm_damp_cough-treatment, `Treatment principle for PHLEGM DAMP cough: strengthen the Spleen dry Damp; transform Phlegm, stop cough.`).
text(phlegm_heat_cough-treatment, `Treatment principle for PHLEGM HEAT cough: Expel Phlegm and clear Heat; redirect Lung qi downward, stop cough.`).
text(spleen_kidney_yang_deficiency_cough-treatment, `Treatment principle for SPLEEN AND KIDNEY YANG DEFICIENCY cough: warm yang, disperse Cold; transform qi to move fluids.`).
text(warm_dryness_cough-treatment, `Treatment principle for WARM DRYNESS cough: clear Heat from the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(wind_cold_cough-treatment, `Treatment principle for WIND COLD cough: expel Wind and Cold; redirect Lung qi downward, stop cough.`).
text(wind_heat_cough-treatment, `Treatment principle for WIND HEAT cough: expel Wind and clear Heat; redirect Lung qi downward, stop cough; transform Phlegm.`).

text(wind_cold_pain-treatment, `Treatment principle for INVASION OF WIND-COLD pain: dispel external cold, promote sweating and relieve pain.`).
text(wind_damp_pain-treatment, `Treatment principle for INVASION OF WIND-DAMP pain: dispel wind, eliminate damp and relieve the pain.`).
text(damp_heat_pain-treatment, `Treatment principle for INVASION OF DAMP-HEAT pain: clear heat and eliminate damp`).
text(liver_qi_stagnation_pain-treatment, `Treatment principle for STAGNATION OF LIVER-QI pain: regulate liver-qi, remove qi stagnation and relieve the pain.`).
text(blood_stagnation_pain-treatment, `Treatment principle for STAGNATION OF BLOOD pain: promote blood circulation, remove blood stagnation and sedate the pain.`).
text(qi_blood_deficiency_pain-treatment, `Treatment principle for DEFICIENCY OF QI AND BLOOD pain: tonify qi and blood and relieve the pain.`).
text(kidney_yin_deficiency_pain-treatment, `Treatment principle for DEFICIENCY OF KIDNEY-YIN pain: nourish kidney-yin and relieve the pain.`).
text(kidney_yang_deficiency_pain-treatment, `Treatment principle for DEFICIENCY OF KIDNEY-YANG pain: tonify kidney, warm the channels and relieve the pain.`).
%

text(talk_sleep, `talk in the sleep`).
text(talkative, `talkative`).
text(taste, `taste`).
text(taste-prompt, `Select the tastes of the mouth?`).
text(tender, `tender`).
text(thick, `thick`).
text(thin, `thin`).
text(thirst, `thirst`).
text(thirst-prompt, `How thirsty does the patient feel?`).
text(throat, `throat`).
text(throat-prompt, `Select the symptoms for the patient's throat:`).
text(throbbing, `throbbing`).
text(ticklish, `ticklish`).
text(tight, `tight`).
text(tightness, `tightness`).
text(time_occur, `time of occurrence`).
text(time_occur-prompt, `Which time of the day does it occur the most?`).
text(tingling, `tingling`).

text(tongue, `tongue`).
text(tongue-prompt, `Select the conditions of the patient's tongue:`).

% tongue diagnosis section
text(tongue_body-prompt, `what is the condition of the tongue body?`).	% 舌体
text(tongue_coat-prompt, `how thick is the patient's tongue coating?`).	% 舌苔
text(tongue_coat_color, `tongue coat color`).	% 舌苔的颜色
text(tongue_coat_color-prompt, `what is the color of the patient's tongue coat?`).
text(tongue_coat_distribution, `tongue coat distribution`).
text(tongue_coat_distribution-prompt, `how is the patient's tongue coat being distributed?`).
text(tongue_coat_root, `tongue coat rooted`).
text(tongue_coat_root-prompt, `Is the patient's tongue coat rooted?`).
text(tongue_coat_texture, `tongue coat texture`).
text(tongue_coat_texture-prompt, `what is the texture of the patient's tongue coat`).
text(tongue_color, `tongue color`).				% 舌色
text(tongue_color-prompt, `what is the color of patient's tongue?`).
text(tongue_shape, `tongue shape`).				% 舌形
text(tongue_shape-prompt, `what is the shape of the patient's tongue?`).
text(tongue_move_state, `tongue move state`).
text(tongue_move_state-prompt, `what is the moving state of the patient's tongue?`).
text(tongue_spirit, `tongue spirit`).			% 舌神
text(tongue_spirit-prompt, `what is the spirit condition of patient's tongue?`).
text(toothmarked, `toothmarked`).
% end of tongue diagnosis section

text(top_body, `top half of the body`).
text(tough, `tough`).								% 苍老

text(trauma, `trauma`).
text(trembling, `trembling`).
text(turbid, `turbid`).
text(turmoil, `emotional turmoil`).

text(upset, `upset`).
text(urgent, `urgent`).

text(very, `very`).
text(voice, `voice`).
text(voice-prompt, `How is the patient's voice?`).
text(vomit, `vomit`).
text(vomit-prompt, `Does patient vomit?`).

text(undigested_food, `undigested food`).
text(urine_color, `urine color`).
text(urine_color-prompt, `What is the color of the urine?`).
text(unroot, `unroot`).

text(wandering, `wandering`).	
text(warmth, `warmth`).
text(watery, `watery`).
text(weak, `weak`).
text(wet, `wet`).
text(wheezing, `wheezing`).
text(white, `white`).
text(whooping, `whooping`).
text(wind_cold, `wind cold`).
text(withered, `withered`).
text(worry, `worry`).
text(worse, `worse`).
text(worse-prompt, `It becomes worsen:`).

text(yellow, `yellow`).
text(yes, `yes`).

% Outputs

% miscellaneous

text(score, `Score`).
text(confirming_signs, `These signs confirm the diagnosis`).
text(negating_signs, `These confirming signs were not found`).

% Patterns

text(wind_cold, `Wind Cold`).
text(wind_heat, `Wind Heat`).
text(warm_dryness, `Warm Dryness`).
text(cool_dryness, `Cool Dryness`).
text(lung_heat, `Lung Heat`).
text(phlegm_damp, `Phlegm Damp`).
text(phlegm_heat, `Phlegm Heat`).
text(liver_fire_invading_lungs, `Liver Fire Invading Lungs`).
text(lung_yin_deficiency, `Lung Yin Deficiency`).
text(lung_qi_deficiency, `Lung Qi Deficiency`).
text(spleen_kidney_yang_deficiency, `Spleen Kidney Yang Deficiency`).
text(blood_stagnation, `Blood Stagnation`).

:- end_module(english).