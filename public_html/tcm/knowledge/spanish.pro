:- set_prolog_flag(utf8io, on).

:- module(spanish).


% this is included to illustrate how to code more complex messages with
% variables in their input.
text(acrid, `acrid`).
text(acute, `acute`).
text(a_meal, `after a meal`).
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

text(b_meal, `before a meal`).
text(barking, `barking`).
text(big, `big`).
text(bitter, `bitter`). 
text(black, `black`).
text(blend, `blend`).
text(bloody,`bloody`).
text(b_body, `bottom half of the body`).
text(body, `on the body`).
text(boring, `boring`).
text(bowel_movement, `bowel movement`).
text(breath, `breathing`).
text(breath-prompt, `How is the patient breathing?`).
text(bruise, `bruise`).
text(burning, `burning`).

text(chest, `chest`).
text(chills, `chills`).
text(chills-prompt, `Does the patient have chills?`).
text(choppy, `choppy`).
text(chronic, `chronic`).
text(clear, `clear`).
text(cold, `cold`).
text(cold_drink, `cold drink`).
text(colicky, `colicky`).
text(complaint, `queja`).
text(complaint-prompt, `¿Que es la mejor queja?`).
text(congested, `congested`).
text(constipation, `constipation`).
text(cough, `tos`).
text(coughing_sound, `coughing sound`).
text(coughing_sound-prompt, `How does the cough sound?`).
text(craving, `craving`).
text(crying, `crying`).
text(cutting, `cutting`).

text(dark, `dark`).
text(dark_very, `very dark`). 
text(dark_yellow, `dark yellow`).
text(delirious, `delirious`).
text(day, `during the day`).
text(deep, `deep`).
text(defecate, `defecate`).
text(depression, `depression`).
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
text(dry, `seco`).
text(dry-prompt, `Parts of the body feel dry:`).
text(dyspnea, `dyspnea`).
 
text(easy, `easy`).
text(eating, `eating`).
text(emptiness, `emptiness`).
text(empty, `empty`).
text(emotion, `emotion`).
text(emotion-prompt, `What are the patient's emotions.`).
text(epigastrium, `epigastrium`).
text(evening, `in the evening`).
text(exertion, `on exertion`).

text(error_missing_ask(Attr), Msg) :-
   get_text(Attr, AttrText),
	stringlist_concat([`There is no way to find a value for:`, AttrText], ` `, Msg).

text(face, `in the face`).
text(complexion, `face color`).
text(complexion-prompt, `What is the color of the patient's face?`).
text(feeble, `feeble`).
text(feelings, `feel`).
text(feelings-prompt, `How does the patient feel?`).
text(feet, `feet`).
text(fever, `fever`).
text(fever-prompt, `Does the patient have fever?`).
text(fine, `fine`).
text(firm, `firm`).
text(floating, `floating`). 
text(flooding, `flooding`).
text(frequent, `frequent`).
text(frontal, `frontal`).
text(full, `full`).
text(fullness, `fullness`).
text(fullness-prompt, `Areas of feeling fullness:`).

text(good, `good`).
text(green, `green`). 
text(groaning, `groaning`).

text(hacking, `hacking`).
text(hands, `hands`).
text(happy, `happy`).
text(hasty, `hasty`).
text(head, `head`).
text(headache, `headache`).
text(heaviness, `heaviness`).
text(heavy, `heavy`).
text(heavy-prompt, `Parts of the body feel heavy:`).
text(hesitation, `hesitation`). 
text(hidden, `hidden`).
text(hoarse, `hoarse`).
text(hollow, `hollow`).
text(hot_drink, `hot drink`).
text(hungery, `hungery`).
text(hurried, `hurried`).
text(hypochondria, `hypochondria`).

text(incoherent, `incoherent`).
text(injury, `injury`).
text(injury, `What type of injury did the patient experience?`).
text(intermittent, `intermittent`).
text(irritability, `irritability`).
text(itchy,`itchy`).

text(knotted, `knotted`).

text(laughing, `laughing`).
text(leather, `leather`).
text(legs, `in the legs`).
text(light_brown, `light brown`).
text(limbs, `limbs`).
text(little, `a little of`). 
text(lips, `lips`).
text(location, `location`).
text(location-prompt, `Where is the problem located?`).
text(long, `long`).
text(long_thin, `long and thin`).
text(loose, `loose`).
text(lots, `a lot of`).
text(loud, `loud`).
text(lower_abdomen, `lower abdomen`).
text(lurking, `lurking`).

text(menu_choice, `Enter the number(s) of choice(s) separated by commas: `).
text(mild, `mild`).
text(minute, `minute`).
text(moderate, `moderate`).
text(moist, `húmedo`).
text(morning, `in the morning`).
text(mouth, `mouth`).
text(moving, `moving`).
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
text(none, `none`).
text(normal, `normal`).
text(nose, `nose`).
text(nose_color, `color of the nose`).
text(not, `not much`).
text(not_often, `not so often`).

text(obstruction, `obstruction`).
text(occipital, `occipital`).
text(occurrence, `how frequent`).
text(occurrence-prompt, `How frequent?`).
text(oedema, `oedema`).
text(oedema-prompt, `Where is the oedema located?`).
text(overflowing, `overflowing`).

text(pain, `dolor`).
text(pain-prompt, `Describe the kind of pain:`).
text(pain_location, `pain location`).
text(pain_location-prompt, `Where is the pain?`).
text(pale, `pale`).
text(pale_yellow, `pale yellow`).
text(palms, `palms`).
text(palpitation, `heart palpitation`).
text(peeled, `peeled (mirror tongue)`).
text(pellets, `pellets`).
text(persistent, `persistent`).
text(poor, `poor`).
text(profuse, `profuse`).
text(pressure, `pressure`).
text(pulling, `pulling`).
text(pulse, `pulso`).
text(pulse-prompt, `Select the qualities of the patient's pulses?`).
text(pungent, `pungent`).
text(purple, `purple`).
text(pushing, `pushing`).

text(quick_temper, `quick temper`).
text(qing, `greenish bluish`).

text(rattling, `rattling`).
text(rapid, `rapid`).
text(rebellious, `rebellious qi`).
text(red, `red`).
text(red_tip, `red tip`).
text(respiratory, `respiratory`).
text(reluctance, `reluctance`).
text(respiratory-prompt, `How is the patient's respiratory?`).
text(rest, `rest`).
text(restlessness, `restlessness`).

text(sad, `sad`).
text(salty, `salty`).
text(scanty, `scanty`).
text(scattered, `scattered`).
text(scratchy, `scratchy`).
text(sensation, `sensation`).
text(sensation-prompt, `What are the patient's sensations? `).
text(slippery, `slippery`).
text(slurred, `slurred`).
text(short, `short`).
text(sigh, `sighing`).
text(slow, `slow`).
text(slowed_down,`slowed down`).
text(sob, `shortness of breath`).
text(soggy, `soggy`).
text(soft, `soft`).
text(sore, `sore`).
text(soreness, `soreness`).
text(sour, `sour`).
text(spastic, `spastic`).
text(speech, `speech`).
text(speech-prompt, `How does the patient's speech?`).
text(spontaneous, `spontaneous`).
text(sputum, `sputum`).
text(sputum-prompt, `Select the quality of the sputum:`).
text(sputum_color, `color of sputum`).
text(sputum_color-prompt, `What is the color of the sputum?`).
text(sputum_amount, `amount of sputum`).
text(sputum_amount-prompt, `What is the amount of the sputum?`).
text(sputum_expectorate, `expectorate sputum`).
text(sputum_expectorate-prompt, `Is sputum easy or difficult to expectorate?`).
text(symptom, `symptom`).
text(symptom-prompt, `Does patient have the following symptoms?`).
text(stage, `stage`).
text(stage-prompt, `What is the stage of the disease?`).
text(sticky, `sticky`).
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

text(t_body, `top half of the body`).
text(talk_sleep, `talk in the sleep`).
text(talkative, `talkative`).
text(taste, `taste`).
text(taste-prompt, `Select the tastes of the mouth?`).
text(thick, `thick`).
text(thin, `thin`).
text(thirst, `thirst`).
text(thirst-prompt, `How thirsty does the patient feel?`).
text(thready, `thready`).

% treatment principles
% cough
text(blood_stagnation_cough, `Treatment principal for BLOOD STAGNATION cough: resolve stagnant Blood in the Lungs, stop cough.`).
text(cool_dryness_cough, `Treatment principal for COOL DRYNESS cough: clear the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(liver_fire_invading_lungs_cough, `Treatment principal for LIVER FIRE INVADING THE LUNGS cough: clear Liver Fire, Moisten the Lungs and transform Phlegm.`).
text(lung_heat_cough, `Treatment principal for LUNG HEAT cough: clear Heat from the Lungs; redirect Lung qi downward, stop cough; transform Phlegm.`).
text(lung_qi_deficiency_cough, `Treatment principal for LUNG QI DEFICIENCY cough: tonify Lung qi, calm cough; transform thin mucus.`).
text(lung_yin_deficiency_cough, `Treatment principal for LUNG YIN DEFICIENCY cough: nourish Lung yin to stop cough; Moisten the Lungs, transform Phlegm.`).
text(phlegm_damp_cough, `Treatment principal for PHLEGM DAMP cough: strengthen the Spleen dry Damp; transform Phlegm, stop cough.`).
text(phlegm_heat_cough, `Treatment principal for PHLEGM HEAT cough: Expel Phlegm and clear Heat; redirect Lung qi downward, stop cough.`).
text(spleen_kidney_yang_deficiency_cough, `Treatment principal for SPLEEN AND KIDNEY YANG DEFICIENCY cough: warm yang, disperse Cold; transform qi to move fluids.`).
text(warm_dryness_cough, `Treatment principal for WARM DRYNESS cough: clear Heat from the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(wind_cold_cough, `Treatment principal for WIND COLD cough: expel Wind and Cold; redirect Lung qi downward, stop cough.`).
text(wind_heat_cough, `Treatment principal for WIND HEAT cough: expel Wind and clear Heat; redirect Lung qi downward, stop cough; transform Phlegm.`).

%

text(throat, `throat`).
text(throat-prompt, `Select the symptoms for the patient's throat:`).
text(throbbing, `throbbing`).
text(ticklish, `ticklish`).
text(time_occur, `time of occurrence`).
text(time_occur-prompt, `Which time of the day does it occur the most?`).
text(tight, `tight`).
text(tongue, `lengua`).
text(tongue-prompt, `Select the conditions of the patient's tongue:`).
text(tongue_color, `tongue color`).
text(tongue_color-prompt, `Select the colors of the patient's tongue:`).
text(tongue_coat, `tongue coat`).
text(tongue_coat-prompt, `Select the thickness of the patient's tongue coat:`).
text(tongue_coat_color, `tongue coat color`).
text(tongue_coat_color-prompt, `Select the color of the patient's tongue coat:`).
text(tongue_coat_texture, `tongue coat texture`).
text(tongue_coat_texture-prompt, `Select the texture of the patient's tongue coat:`).
text(tongue_coat_distribution, `tongue coat distribution`).
text(tongue_coat_distribution-prompt, `Select the distribution of the patient's tongue coat:`).
text(tongue_coat_root, `tongue coat rooted`).
text(tongue_coat_root-prompt, `Is the patient's tongue coat rooted:`).
text(tongue_shape, `tongue shape`).
text(tongue_shape-prompt, `Select the shapes of the patient's tongue:`).
text(trauma, `trauma`).
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

text(warmth, `warmth`).
text(watery, `watery`).
text(weak, `weak`).
text(wheezing, `wheezing`).
text(wind_cold, `wind cold`).
text(wind_cold_points,
  [`Treat wind cold by redirecting `,
   `lung qi downwards` ]).
text(wiry, `wiry`).
text(whooping, `whooping`).
text(worry, `worry`).
text(worse, `worse`).
text(worse-prompt, `It becomes worsen:`).

text(yellow, `yellow`).
text(yes, `yes`).

:- end_module(spanish).