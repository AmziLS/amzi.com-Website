:- set_prolog_flag(utf8io, on).

:- module(chinese).

% this is included to illustrate how to code more complex messages with
% variables in their input.

% pulses

% pulse qualities
text(big_pulse, `大脉`).	
text(choppy_pulse, `涩脉`).				% rough, hesitant
text(empty_pulse, `虚脉`).				% deplete, weak, deficiency
text(fine_pulse, `细脉`).				% thin, thready, small, minute
text(firm_pulse, `牢脉`).
text(floating_pulse, `浮脉`). 
text(full_pulse, `实脉`).				% replete, excess, strong
text(hidden_pulse, `伏脉`).
text(hollow_pulse, `芤脉`).				% scallion stalk
text(intermittent_pulse, `代脉`).		% interrupted
text(knotted_pulse, `结脉`).			% bound
text(leather_pulse, `革脉`).			% drumskin
text(long_pulse, `长脉`).				% 
text(minute_pulse, `微脉`).				% faint, feeble
text(moderate_pulse, `缓脉`).			% retarded
text(moving_pulse, `动脉`).				% stirred, spinning bean, shaking, throbbing
text(racing_pulse, `疾脉`).				% swift
text(rapid_pulse, `数脉`).
text(scattered_pulse, `散脉`).
text(short_pulse, `短脉`).
text(sinking_pulse, `沉脉`).			% sunken, submerged
text(skipping_pulse, `促脉`).			% hasty, abrupt, hurried, running
text(slippery_pulse, `滑脉`).			% smooth, rolling
text(slow_pulse, `迟脉`).
text(soggy_pulse, `濡脉`).				% soft, weak, floating or frail
text(surging_pulse, `洪脉`).			% overflowing, flooding
text(tight_pulse, `紧脉`).				% tense, taut or squeezed
text(weak_pulse, `弱脉`).				% frail
text(wiry_pulse, `弦脉`).				% stringlike
% end of pulse qualities

% pulse prompts
text(pulse_contour, `脉形`).
text(pulse_contour-prompt, `脉形`).
text(pulse_depth, `脉深度 `).
text(pulse_depth-prompt, `脉深度 `).
text(pulse_force, `脉力`).
text(pulse_force-prompt, `脉力`).
text(pulse_length, `脉长度)`).
text(pulse_length-prompt, `脉长度)`).
text(pulse_rate, `脉速度`).
text(pulse_rate-prompt, `脉速度`).
text(pulse_rhythm, `脉节奏`).
text(pulse_rhythm-prompt, `脉节奏`).
text(pulse_tension, `脉张力 `).
text(pulse_tension-prompt, `脉张力 `).
text(pulse_width, `脉宽度`).
text(pulse_width-prompt, `脉宽度`).
% end of pulse prompts

% end of pulses

% diagnosis section
%	patterns
text(blood_stagnation, `血瘀`).
text(cool_dryness, `凉风燥`).
text(damp_heat, `湿热`).
text(kidney_yang_deficiency, `肾阳虚`).
text(kidney_yin_deficiency, `肾阴虚`).
text(liver_fire_invading_lungs, `肝火犯肺`).
text(liver_qi_stagnation, `肝气滞`).
text(lung_heat, `肺热`).
text(lung_qi_deficiency, `肺气虚`).
text(lung_yin_deficiency, `肺阴不足`).
text(phlegm_damp, `痰湿`).
text(phlegm_heat, `痰热`).
text(qi_blood_deficiency, `血气虚`).
text(spleen_kidney_yang_deficiency, `肾脾阳虚`).
text(warm_dryness, `温风燥`).
text(wind_cold, `风寒`).
text(wind_damp, `风湿`).
text(wind_heat, `风热`).
%	end of patterns

% end of diagnosis

% others
text(ache, `疼痛`).
text(acrid, `辛`).
text(acute, `急性`).
text(after_meal, `饭后`).
text(afternoon, `中午`).
text(aggravate, `使恶化 `).
text(aggravate-prompt, `The problem is aggravated by:`).
text(ameliorate, `改善`).
text(ameliorate-prompt, `The problem could be ameliorated by:`).
text(anger, `怒`).
text(angry, `怒`).
text(appetite, `口味`).
text(appetite-prompt, `患者的口味?`).
text(average, `平均`).
text(aversion, `反感`).
text(aversion-prompt, `Is patient aversion to:`).
text(axillae, `腋窝`).

text(back, `背后`).
text(barking, `barking`).
text(before_meal, `饭前`).
text(big, `大`).
text(bitter, `苦`). 
text(black, `黑`).
text(bleak, `苍老`).
text(blend, `blend`).
text(bloody,`有血`).
text(blue, `青`).
text(body, `全身`).
text(bottom_body, `下半身`).
text(boring, `boring`).
text(bowel_movement, `通大便`).
text(breath, `呼吸`).
text(breath-prompt, `How is the patient breathing?`).
text(brown, `褐色`).
text(bruise, `碰伤`).
text(burning, `burning`).

text(center, `中心`).
text(chest, `胸`).
text(chills, `寒冷`).
text(chills-prompt, `Does the patient have chills?`).
text(chronic, `慢性`).
text(clear, `透明`).
text(cold, `寒`).
text(cold_drink, `冷水`).
text(colicky, `colicky`).
text(complaint, `疾病`).
text(complaint-prompt, `有何疾病?`).
text(complexion, `脸色`).
text(complexion-prompt, `What is the color of the patient's face?`).
text(congested, `拥塞`).
text(constipation, `便秘`).
text(constitution, `体质`). 
text(cough, `咳嗽`).
text(coughing_sound, `咳嗽声`).
text(coughing_sound-prompt, `How does the cough sound?`).
text(craving, `渴望`).
text(crimson, `绛`).
text(crying, `哭`).
text(curdy, `腐腻`).
text(cutting, `cutting`).

text(dark, `黑暗`).
text(dark_very, `很黑暗`). 
text(dark_yellow, `黑黄`).
text(delirious, `谵`).
text(day, `白天`). 
text(deep_pulse, `沉`).
text(defecate, `大便`).
text(depression, `抑郁症`).
text(deviated, `歪斜`).
text(diarrhoea, `腹泻`).
text(difficult, `困难`).
text(discharge, `泄（鼻涕、带下、等等）`).
text(discharge_color, `discharge color`).
text(discomfort, `不舒服`).
text(discomfort-prompt, `Areas of discomfort:`).
text(dislike, `不喜欢`).
text(distending, `膨胀`).
text(distressing, `忧伤`).
text(dizziness, `头晕`).
text(double_tongue, `重`).
text(dry, `燥`).
text(dry-prompt, `Parts of the body feel dry:`).
text(dyspnea, `呼吸困难`).
 
text(easy, `容易`).
text(eating, `饮食`).
text(emptiness, `空`).
text(emotion, `情感`).
text(emotion-prompt, `What are the patient's emotions?`).
text(energy-prompt, `What is the patient's level energy?`).
text(epigastrium, `上腹部`).
text(evening, `晚上`).
text(exertion, `尽力`).
text(exfoliative, `剥落`).

text(error_missing_ask(Attr), Msg) :-
   get_text(Attr, AttrText),
	stringlist_concat([`There is no way to find a value for:`, AttrText], ` `, Msg).

text(face, `脸`).
text(fat, `胖`).
text(fatigue, `疲劳`).
text(feeble, `虚弱`).
text(feelings, `感觉`).
text(feelings-prompt, `How does the patient feel?`).
text(feet, `足`).
text(fever, `发热`).
text(fever-prompt, `Does the patient have fever?`).
text(fissured, `裂纹`).
text(flaccid, `痿软`).
text(frequent, `经常`).
text(frontal, `迎头`).
text(full, `全`).
text(fullness, `fullness`).
text(fullness-prompt, `Areas of feeling fullness:`).

text(good, `好`).
text(green, `蓝色`). 
text(greasy, `greasy`).
text(grey, `灰色`).
text(groaning, `呻吟 `).

text(hacking, `hacking`).
text(hands, `手`).
text(happy, `愉快`).
text(hasty, `促`).
text(head, `头`).
text(headache, `头疼`).
text(heat, `热度`).
text(heaviness, `重`).
text(heavy, `重`).
text(heavy-prompt, `Parts of the body feel heavy:`).
text(hesitation, `hesitation`).
text(heavy, `高`). 
text(hemialgia, `偏侧痛`).
text(hoarse, `hoarse`).
text(hot_drink, `热水`).
text(hungery, `饥饿`).
text(hypochondria, `下骨片`).

text(incoherent, `颠三倒四`).
text(injury, `受伤`).
text(injury, `What type of injury did the patient experience?`).
text(insomnia, `失眠`).
text(irritability, `暴躁`).
text(itchy,`痒`).

text(joint, `关节`).

text(laughing, `笑`).
text(leather, `革`).
text(legs, `腿`).
text(light, `淡`).
text(limb, `四肢`).
text(little, `一点`). 
text(lips, `嘴唇`).
text(location, `location`).
text(location-prompt, `Where is the problem located?`).
text(long, `长`).
text(long_thin, `长细`).
text(loose, `loose`).
text(lots, `挺多`).
text(loud, `大声`).
text(lower_abdomen, `下腹`).
text(lower_back, `下背`). 
text(lurking, `lurking`).
text(lustrous, `有神`).  

text(menu_choice, `Enter a list in brackets, i.e. [2,7]: `).
text(mild, `轻微`).
text(moist, `润`).
text(morning, `凌晨`).
text(mouth, `口`).
text(moving, `移动`).
text(mouldy, `发霉`).
text(mucus, `鼻涕`).
text(muffled, `muffled`).
text(muscle, `肌肉`).
text(muttering, `muttering to oneself`).

text(nasal, `鼻`).
text(nasal-prompt, `Does the patient's nasal have:`).
text(nausea, `恶心`).
text(neck, `颈`).
text(night, `黑夜`).
text(no, `否`).
text(no_drink, `口渴不喝水`).
text(none, `没有`).
text(normal, `正常`).
text(nose, `鼻`).
text(nose_color, `鼻色`).
text(not_often, `不经常 `).
text(numbness, `麻痹`).

text(obstruction, `障碍（鼻塞）`).
text(occipital, `枕部`).
text(occurrence, `how frequent`).
text(occurrence-prompt, `How frequent?`).
text(oedema, `水肿`).
text(oedema-prompt, `Where is the oedema located?`).

text(pain, `疼痛`).
text(pain-prompt, `Describe the kind of pain:`).
text(pain_location, `pain location`).
text(pain_location-prompt, `Where is the pain?`).
text(pale, `苍白`).
text(palm, `手掌`).
text(partial, `偏`).
text(palpitation, `心悸 `).
text(pantalgia, `全身痛`).
text(peeled, `peeled (mirror tongue)`).
text(pellets, `pellets`).
text(persistent, `persistent`).
text(pink, `淡红`). 
text(poor, `食欲不正`).
text(profuse, `过多`).
text(protruding, `吐弄`).
text(pressure, `压力`).
text(pulling, `pulling`).
text(pulse, `脉`).
text(pulse-prompt, `Select the qualities of the patient's pulses?`).
text(pungent, `pungent`).
text(purple, `紫`).
text(pushing, `pushing`).
text(putrid, `腐臭`).

text(quick_temper, `火性`).
text(quivering, `颤动`).

text(rattling, `rattling`).
text(rebellious, `rebellious qi`).
text(red, `红`).
text(red_tip, `red tip`).
text(respiratory, `respiratory`).
text(reluctance, `不情愿`).
text(respiratory-prompt, `How is the patient's respiratory?`).
text(rest, `休息 `).
text(restlessness, `烦躁不安`).
text(root, `有根`).
text(retracted, `短缩`).
text(rough, `糙`).

text(sad, `伤心`).
text(salty, `咸`).
text(scanty, `稀疏`).
text(scratchy, `scratchy`).
text(sensation, `sensation`).
text(sensation-prompt, `What are the patient's sensations? `).
text(sharp, ``).
text(short, `短`).
text(sides, `边`).
text(sigh, `叹气`).
text(site, `site where the problem occur`).
text(site-prompt, `病症发生在那处?`).
text(sleep, `睡眠`).
text(slippery, `滑`).
text(slow, `慢`).
text(slurred, `slurred`).
text(small, `小`).
text(snow, `雪花`).
text(sob, `呼吸急促`).
text(soft, `軟`).
text(sole, `脚掌`).
text(sore, `酸疼`).
text(soreness, `酸疼`).
text(sour, `酸`).
text(spastic, `痉挛`).
text(speech, `发言`).
text(speech-prompt, `How does the patient's speech?`).
text(spontaneous, `自汗`).
text(spotted, `敕`).
text(sputum, `痰`).
text(sputum-prompt, `Select the quality of the sputum:`).
text(sputum_color, `痰的颜色`).
text(sputum_color-prompt, `What is the color of the sputum?`).
text(sputum_amount, `痰的数量`).
text(sputum_amount-prompt, `What is the amount of the sputum?`).
text(sputum_expectorate, `expectorate sputum`).
text(sputum_expectorate-prompt, `Is sputum easy or difficult to expectorate?`).
text(stabbing, `stabbing`).
text(stage, `stage`).
text(stage-prompt, `What is the stage of the disease?`).
text(sticky, `黏`).
text(stiff, `强硬`).
text(stiffness, `强硬`).
text(stiffness-prompt, `Areas of having stiffness:`).
text(stomach, `胃`).
text(stool, `屎`).
text(stool-prompt, `What is the quality of the stools?`).
text(stool_color, `stool color`).
text(stool_color-prompt, `What is the color of the stools?`).
text(stool_shape, `stool shape`).
text(stool_shape-prompt, `What is the shape of the stools?`).
text(stress, `压力`).
text(stressful, `紧张`).
text(strong, `强壮`).
text(stuffiness, `沉闷`).
text(stuffiness-prompt, `Areas of feeling stuffiness:`).
text(stuttering, `謇`).
text(sweat, `出汗`).
text(sweat-prompt, `How much does the patient sweat?`).
text(sweat_area, `areas of sweating`).
text(sweat_area-prompt, `Where are areas of sweating?`).
text(sweet, `甜`).
text(swelling, `肿胀`).
text(swollen, `肿胀`).
text(symptom, `症状`).
text(symptom-prompt, `患者有何症状?`).

text(talk_sleep, `talk in the sleep`).
text(talkative, `talkative`).
text(taste, `味道 `).
text(taste-prompt, `有任何口味?`).
text(tender, `娇嫩`).
text(thick, `厚`).
text(thin, `薄`).
text(thirst, `口渴`).
text(thirst-prompt, `有否口渴?`).
text(throat, `咽喉`).
text(throat-prompt, `咽喉如何?`).
text(throbbing, `振动`).
text(ticklish, `痒`).
text(tight, `紧`).
text(tightness, `紧`).
text(time_occur, `何时`).
text(time_occur-prompt, `何时发生?`).
text(tingling, `麻刺感`).


text(tongue_body-prompt, `患者的舌体?`).
text(tongue_coat-prompt, `患者的舌苔?`).
text(tongue_coat_color, `舌苔的颜色`).
text(tongue_coat_color-prompt, `舌苔的颜色?`).
text(tongue_coat_distribution, `tongue coat distribution`).
text(tongue_coat_distribution-prompt, `how is the patient's tongue coat being distributed?`).
text(tongue_coat_texture, `tongue coat texture`).
text(tongue_coat_texture-prompt, `what is the texture of the patient's tongue coat`).
text(tongue_color, `舌色`).
text(tongue_color-prompt, `患者的舌色?`).
text(tongue_shape, `舌形`).
text(tongue_shape-prompt, `患者的舌形?`).
text(tongue_move_state, `tongue move state`).
text(tongue_move_state-prompt, `what is the moving state of the patient's tongue?`).
text(tongue_spirit, `舌神`).
text(tongue_spirit-prompt, `患者的舌神?`).
text(tough, `苍老`).

% treatment principles
% cough
text(blood_stagnation_cough, `Treatment principle for BLOOD STAGNATION cough: resolve stagnant Blood in the Lungs, stop cough.`).
text(cool_dryness_cough, `Treatment principle for COOL DRYNESS cough: clear the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(liver_fire_invading_lungs_cough, `Treatment principle for LIVER FIRE INVADING THE LUNGS cough: clear Liver Fire, Moisten the Lungs and transform Phlegm.`).
text(lung_heat_cough, `Treatment principle for LUNG HEAT cough: clear Heat from the Lungs; redirect Lung qi downward, stop cough; transform Phlegm.`).
text(lung_qi_deficiency_cough, `Treatment principle for LUNG QI DEFICIENCY cough: tonify Lung qi, calm cough; transform thin mucus.`).
text(lung_yin_deficiency_cough, `Treatment principle for LUNG YIN DEFICIENCY cough: nourish Lung yin to stop cough; Moisten the Lungs, transform Phlegm.`).
text(phlegm_damp_cough, `Treatment principle for PHLEGM DAMP cough: strengthen the Spleen dry Damp; transform Phlegm, stop cough.`).
text(phlegm_heat_cough, `Treatment principle for PHLEGM HEAT cough: Expel Phlegm and clear Heat; redirect Lung qi downward, stop cough.`).
text(spleen_kidney_yang_deficiency_cough, `Treatment principle for SPLEEN AND KIDNEY YANG DEFICIENCY cough: warm yang, disperse Cold; transform qi to move fluids.`).
text(warm_dryness_cough, `Treatment principle for WARM DRYNESS cough: clear Heat from the Lungs, moisten Dryness; redirect Lung qi downward, stop cough.`).
text(wind_cold_cough, `Treatment principle for WIND COLD cough: expel Wind and Cold; redirect Lung qi downward, stop cough.`).
text(wind_heat_cough, `Treatment principle for WIND HEAT cough: expel Wind and clear Heat; redirect Lung qi downward, stop cough; transform Phlegm.`).

text(invasion_wind_cold_pain, `Treatment principle for INVASION OF WIND-COLD pain: dispel external cold, promote sweating and relieve pain.`).
text(invasion_wind_damp_pain, `Treatment principle for INVASION OF WIND-DAMP pain: dispel wind, eliminate damp and relieve the pain.`).
text(invasion_damp_heat_pain, `Treatment principle for INVASION OF DAMP-HEAT pain: clear heat and eliminate damp`).
text(stagnation_liver_qi_pain, `Treatment principle for STAGNATION OF LIVER-QI pain: regulate liver-qi, remove qi stagnation and relieve the pain.`).
text(stagnation_blood_pain, `Treatment principle for STAGNATION OF BLOOD pain: promote blood circulation, remove blood stagnation and sedate the pain.`).
text(deficiency_qi_blood_pain, `Treatment principle for DEFICIENCY OF QI AND BLOOD pain: tonify qi and blood and relieve the pain.`).
text(deficiency_kidney_yin_pain, `Treatment principle for DEFICIENCY OF KIDNEY-YIN pain: nourish kidney-yin and relieve the pain.`).
text(deficiency_kidney_yang_pain, `Treatment principle for DEFICIENCY OF KIDNEY-YANG pain: tonify kidney, warm the channels and relieve the pain.`).
%

text(tongue, `舌`).
text(tongue-prompt, `挑选患者的舌神:`).

% tongue diagnosis section
text(tongue_body, `舌体`). 
text(tongue_body-prompt, `患者的舌体如何？`). 
text(tongue_coat, `舌苔`).
text(tongue_coat-prompt, `患者的舌苔如何？`).
text(tongue_coat_color, `舌苔的颜色`).
text(tongue_coat_color-prompt, `挑选患者的苔色:`).
text(tongue_coat_texture, `苔质`).
text(tongue_coat_texture-prompt, `挑选患者的苔质:`).
text(tongue_coat_distribution, `tongue coat distribution`).
text(tongue_coat_distribution-prompt, `Select the distribution of the patient's tongue coat:`).
text(tongue_coat_root, `tongue coat rooted`).
text(tongue_coat_root-prompt, `Is the patient's tongue coat rooted:`).
text(tongue_color, `舌头的颜色`).
text(tongue_color-prompt, `挑选患者的舌色:`).
text(tongue_move_state, `tongue move state`).
text(tongue_move_state-prompt, `what is the moving state of the patient's tongue?`).
text(tongue_shape, `舌形`).
text(tongue_shape-prompt, `挑选患者的舌形:`).
text(tongue_spirit, `舌神`).
text(tongue_spirit-prompt, `挑选患者的舌神:`).
text(tongue, `舌`).
text(tongue-prompt, `患者的舌头症状:`).
text(toothmarked, `齿痕`).
% end of tongue diagnosis section

text(top_body, `上半身`).
text(trauma, `损伤`).
text(trembling, `颤动`).
text(turbid, `浊`).
text(turmoil, `emotional turmoil`).

text(upset, `心烦意乱`).
text(urgent, `紧急`).

text(very, `很`).
text(voice, `声音`).
text(voice-prompt, `患者的声音?`).
text(vomit, `呕吐`).
text(vomit-prompt, `患者有没有呕吐?`).

text(undigested_food, `不消化`).
text(urine_color, `尿的颜色`).
text(urine_color-prompt, `尿的颜色?`).
text(unroot, `无根`).

text(wandering, `wandering`).	
text(warmth, `温暖`).
text(watery, `滑`).
text(weak, `虚弱`).
text(wet, `潮湿`).
text(wheezing, `哮喘`).
text(white, `白`).
text(whooping, `百日咳`).
text(wind_cold, `风寒`).
text(withered, `无神`).
text(worry, `忧虑`).
text(worse, `加剧`).
text(worse-prompt, `加剧:`).

text(yellow, `黄`).
text(yes, `是`).

% Outputs

% miscellaneous

text(score, `Score`).
text(confirming_signs, `These signs confirm the diagnosis`).
text(negating_signs, `These confirming signs were not found`).

% Patterns

text(wind_cold, `风冷`).
text(wind_heat, `风热`).
text(warm_dryness, `温暖干燥`).
text(cool_dryness, `凉爽干燥`).
text(lung_heat, `肺热`).
text(phlegm_damp, `痰湿`).
text(phlegm_heat, `痰热`).
text(liver_fire_invading_lungs, `肝火入侵肺部`).
text(lung_yin_deficiency, `肺阴虚`).
text(lung_qi_deficiency, `肺气虚`).
text(spleen_kidney_yang_deficiency, `脾肾阳虚`).
text(blood_stagnation, `血瘀`).


:- end_module(chinese).