<?php
require_once 'app/config.php';
require_once 'app/core/Database.php';

$db = new Database();

// Truncate table to start fresh
echo "Clearing existing impact data...\n";
$db->query("TRUNCATE TABLE impact_data");
$db->execute();

$impacts = [
    // --- HOME PAGE ---
    // Section: Main
    ['home', 'Main', '', '', 'Ton Sampah Terkelola', 'Managed Waste', '513.03', 'Tonnes', '', '', 'waste', 1],
    ['home', 'Main', '', '', 'Rumah Tangga Terlibat', 'Households Involved', '3189', 'Households', '', '', 'home', 2],
    ['home', 'Main', '', '', 'Lapangan Kerja Hijau', 'Green Jobs Created', '113', 'Jobs', '', '', 'work', 3],
    ['home', 'Main', '', '', 'Tingkat Daur Ulang', 'Recycling Rate', '26.76', '%', '', '', 'recycle', 4],

    // Section: Sustainability
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Source separation rate of collected inorganic waste (Waste Bank)', 'Source separation rate of collected inorganic waste (Waste Bank)', '2392', 'HH', 'Household waste separation participating in the programme.', 'Household waste separation participating in the programme.', '', 1],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Leakage prevented - Waste collected total', 'Leakage prevented - Waste collected total', '513.03', 'Tonnes', 'Cumulative waste collected through the programme from start to current reporting date.', 'Cumulative waste collected through the programme from start to current reporting date.', '', 2],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Valorised - Waste recycled total', 'Valorised - Waste recycled total', '137.3', 'Tonnes', 'Total waste valorised/recycled from start of the project.', 'Total waste valorised/recycled from start of the project.', '', 3],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Inorganic waste collected (from Waste Bank)', 'Inorganic waste collected (from Waste Bank)', '81.33', 'Tonnes', 'Amount of inorganic waste collected through waste banks.', 'Amount of inorganic waste collected through waste banks.', '', 4],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Organic waste (Composted)', 'Organic waste (Composted)', '41.09', 'Tonnes', 'Amount of organic waste processed into compost.', 'Amount of organic waste processed into compost.', '', 5],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Plastic content recycled', 'Plastic content recycled', '55', 'Tonnes', 'Total plastic waste recycled.', 'Total plastic waste recycled.', '', 6],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Paper & card content recycled', 'Paper & card content recycled', '27.01', 'Tonnes', 'Total paper and cardboard recycled.', 'Total paper and cardboard recycled.', '', 7],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'Metals content recycled', 'Metals content recycled', '3.3', 'Tonnes', 'Total metal waste recycled.', 'Total metal waste recycled.', '', 8],
    ['home', 'Sustainability', 'Sustainability Impact', 'Sustainability Impact', 'GHG emissions prevented in Pilot Villages total', 'GHG emissions prevented in Pilot Villages total', '> 161', 'Tonnes CO2eq', 'Estimated greenhouse gas emissions avoided through the sustainable waste management system in pilot villages.', 'Estimated greenhouse gas emissions avoided through the sustainable waste management system in pilot villages.', '', 9],

    // Section: Social
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Individuals attended behavioural change events', 'Individuals attended behavioural change events', '2239', 'People', 'Number of individuals who participated in community-level education and engagement activities.', 'Number of individuals who participated in community-level education and engagement activities.', '', 1],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Education/behavior change events', 'Education/behavior change events', '23', 'Events', 'Number of education, awareness, and behavior change events conducted.', 'Number of education, awareness, and behavior change events conducted.', '', 2],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Hotspots cleared (clearing events)', 'Hotspots cleared (clearing events)', '8', 'Hotspots', 'Number of illegal dumping sites (hotspots) successfully cleared.', 'Number of illegal dumping sites (hotspots) successfully cleared.', '', 3],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'School students receiving training', 'School students receiving training', '1914', 'Students', 'Number of students reached through environmental education programmes in schools.', 'Number of students reached through environmental education programmes in schools.', '', 4],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Schools participating in educational video campaign', 'Schools participating in educational video campaign', '45', 'Schools', 'Number of primary and middle schools involved in the educational video competition.', 'Number of primary and middle schools involved in the educational video competition.', '', 5],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Number of formal partnerships established', 'Number of formal partnerships established', '7', 'Partners', 'Partnerships with formal entities such as the private sector and government agencies.', 'Partnerships with formal entities such as the private sector and government agencies.', '', 6],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Informal sector waste workers/recyclers benefited', 'Informal sector waste workers/recyclers benefited', '4', 'Sectors', 'Number of informal sector associations or groups integrated or supported.', 'Number of informal sector associations or groups integrated or supported.', '', 7],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Public engagement through Social Media publications', 'Public engagement through Social Media publications', '169.215', 'Views', 'Online reach and engagement concerning waste management and sustainability content.', 'Online reach and engagement concerning waste management and sustainability content.', '', 8],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Toolkits supporting waste facility (TPS 3R) optimization', 'Toolkits supporting waste facility (TPS 3R) optimization', '584', 'Toolkits', 'Items provided to optimize waste facility operations (e.g., tools, signs, etc.).', 'Items provided to optimize waste facility operations (e.g., tools, signs, etc.).', '', 9],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Toolkits supporting behavior change developed', 'Toolkits supporting behavior change developed', '> 476', 'Media', 'Educational materials developed to support community awareness (posters, slides, modules, etc.).', 'Educational materials developed to support community awareness (posters, slides, modules, etc.).', '', 10],
    ['home', 'Social', 'Project & Social Impact', 'Project & Social Impact', 'Toolkits developed to support decision-making', 'Toolkits developed to support decision-making', '36', 'Toolkits', 'Frameworks or tools designed to assist stakeholders in planning and system optimization.', 'Frameworks or tools designed to assist stakeholders in planning and system optimization.', '', 11],


    // --- GOSIRK INSTITUTE (GI) ---
    // Section: Main
    ['gi', 'Main', '', '', 'Penelitian Terlaksana', 'Research Completed', '3', 'Research', '', '', 'search', 1],
    ['gi', 'Main', '', '', 'Desa/Kelurahan Didampingi', 'Villages Assisted', '3', 'Villages', '', '', 'location', 2],
    ['gi', 'Main', '', '', 'Penerima Manfaat', 'Beneficiaries', '299', 'People', '', '', 'people', 3],
    ['gi', 'Main', '', '', 'Media Edukasi', 'Educational Media', '5', 'Modules', '', '', 'book', 4],

    // Section: Collapse
    ['gi', 'Collapse', '', '', 'Mitra/Partner Terjalin', 'Mitra/Partner Terjalin', '1', 'Mitra', 'Kolaborasi strategis dengan mitra seperti Banyuwangi Hijau untuk program pengelolaan sampah terpadu.', 'Kolaborasi strategis dengan mitra seperti Banyuwangi Hijau untuk program pengelolaan sampah terpadu.', '', 1],
    ['gi', 'Collapse', '', '', 'Pelatihan Terlaksana', 'Pelatihan Terlaksana', '2', 'Kegiatan', 'Pelatihan Model Bisnis BUMDes & Workshop Pengembangan Bisnis UPTD PPK-BLUD.', 'Pelatihan Model Bisnis BUMDes & Workshop Pengembangan Bisnis UPTD PPK-BLUD.', '', 2],
    ['gi', 'Collapse', '', '', 'Penerima Manfaat', 'Penerima Manfaat', '31', 'Orang', 'Partisipan dari desa, TPS 3R, BWH, dan Dinas LH yang mengikuti training/workshop.', 'Partisipan dari desa, TPS 3R, BWH, dan Dinas LH yang mengikuti training/workshop.', '', 3],
    ['gi', 'Collapse', '', '', 'Media Edukasi', 'Media Edukasi', '32', 'Sarana', 'Terdiri dari buku saku (modul), slide materi, dan lembar kerja assessment yang didistribusikan.', 'Terdiri dari buku saku (modul), slide materi, dan lembar kerja assessment yang didistribusikan.', '', 4],
    ['gi', 'Collapse', '', '', 'Tumblr Terdistribusi', 'Tumblr Terdistribusi', '29', 'Unit', 'Kampanye penggunaan botol guna ulang untuk mengurangi plastik sekali pakai selama kegiatan pelatihan.', 'Kampanye penggunaan botol guna ulang untuk mengurangi plastik sekali pakai selama kegiatan pelatihan.', '', 5],
    ['gi', 'Collapse', '', '', 'Public Engagement', 'Public Engagement', '2.324', 'Viewers', 'Total penonton dan individu yang teredukasi melalui publikasi acara training di Instagram & Youtube.', 'Total penonton dan individu yang teredukasi melalui publikasi acara training di Instagram & Youtube.', '', 6],


    // --- IMPLEMENTASI PARTNER (WP 1-9) ---
    // WP 1
    ['partner', 'WP 1', 'WP 1: Training and Capacity Building in Village-Level', 'WP 1: Training and Capacity Building in Village-Level', 'Trainings/Workshops completed', 'Trainings/Workshops completed', '15', 'Trainings/Workshop', '15 operational-level trainings/workshops were completed during the reporting period.', '15 operational-level trainings/workshops were completed during the reporting period.', '', 1],
    ['partner', 'WP 1', 'WP 1: Training and Capacity Building in Village-Level', 'WP 1: Training and Capacity Building in Village-Level', 'Number of individuals trained (feminine/masculine)', 'Number of individuals trained (feminine/masculine)', '299', 'Individuals', '299 individuals (150 male, 149 female) participated in village-level training sessions covering programme planning, financial management, communication, operations and HSE skills, as well as study visits.', '299 individuals (150 male, 149 female) participated in village-level training sessions covering programme planning, financial management, communication, operations and HSE skills, as well as study visits.', '', 2],
    ['partner', 'WP 1', 'WP 1: Training and Capacity Building in Village-Level', 'WP 1: Training and Capacity Building in Village-Level', 'Number of training/workshop days', 'Number of training/workshop days', '14', 'Days', 'A total of 14 training/workshop days were delivered.', 'A total of 14 training/workshop days were delivered.', '', 3],
    ['partner', 'WP 1', 'WP 1: Training and Capacity Building in Village-Level', 'WP 1: Training and Capacity Building in Village-Level', 'Number of learning modules produced', 'Number of learning modules produced', '5', 'Modules', 'A total of 5 modules produced, available in both hardcopy and digital PDF formats, enabling use as online and offline learning materials.', 'A total of 5 modules produced, available in both hardcopy and digital PDF formats, enabling use as online and offline learning materials.', '', 4],

    // WP 2
    ['partner', 'WP 2', 'WP 2: Training and Capacity Building for Local Government Officials', 'WP 2: Training and Capacity Building for Local Government Officials', 'Trainings/Workshops completed', 'Trainings/Workshops completed', '1', 'Workshop', '1 training/workshop completed for local government officials (Dinas LH).', '1 training/workshop completed for local government officials (Dinas LH).', '', 1],
    ['partner', 'WP 2', 'WP 2: Training and Capacity Building for Local Government Officials', 'WP 2: Training and Capacity Building for Local Government Officials', 'Number of individuals trained (feminine/masculine)', 'Number of individuals trained (feminine/masculine)', '32', 'Individuals', '32 government representatives trained in sustainable waste management strategies.', '32 government representatives trained in sustainable waste management strategies.', '', 2],
    ['partner', 'WP 2', 'WP 2: Training and Capacity Building for Local Government Officials', 'WP 2: Training and Capacity Building for Local Government Officials', 'Number of training/workshop days', 'Number of training/workshop days', '1', 'Full-Day', 'One full day intensive workshop.', 'One full day intensive workshop.', '', 3],

    // WP 3
    ['partner', 'WP 3', 'WP 3: System Planning and Decision-making Support', 'WP 3: System Planning and Decision-making Support', 'Number of WMP politically approved', 'Number of WMP politically approved', '6', 'Planning Document', '6 Waste Management Plans (WMPs) politically approved by village governments.', '6 Waste Management Plans (WMPs) politically approved by village governments.', '', 1],
    ['partner', 'WP 3', 'WP 3: System Planning and Decision-making Support', 'WP 3: System Planning and Decision-making Support', 'Number of plans developed on operational level', 'Number of plans developed on operational level', '3', 'Planning Document', '3 Operational plans developed to support daily waste management activities.', '3 Operational plans developed to support daily waste management activities.', '', 2],

    // WP 4
    ['partner', 'WP 4', 'WP 4: Enabling Sustainable Pre-disposal Treatment System', 'WP 4: Enabling Sustainable Pre-disposal Treatment System', 'Number of villages or towns with access to pre-disposal waste treatment', 'Number of villages or towns with access to pre-disposal waste treatment', '3', 'Villages', '3 villages now have operational pre-disposal waste treatment access.', '3 villages now have operational pre-disposal waste treatment access.', '', 1],
    ['partner', 'WP 4', 'WP 4: Enabling Sustainable Pre-disposal Treatment System', 'WP 4: Enabling Sustainable Pre-disposal Treatment System', 'Number of MRFs partnerships', 'Number of MRFs partnerships', '3', 'Partnerships', '3 Material Recovery Facilities (MRFs) established or optimized through partnerships.', '3 Material Recovery Facilities (MRFs) established or optimized through partnerships.', '', 2],

    // WP 5
    ['partner', 'WP 5', 'WP 5: Establishing Business and Sector Collaboration', 'WP 5: Establishing Business and Sector Collaboration', 'Number of formal partnerships established', 'Number of formal partnerships established', '7', 'Private Sector Partners', '7 formal partnerships established with various stakeholders.', '7 formal partnerships established with various stakeholders.', '', 1],
    ['partner', 'WP 5', 'WP 5: Establishing Business and Sector Collaboration', 'WP 5: Establishing Business and Sector Collaboration', 'Number of informal sector waste workers/recyclers benefited', 'Number of informal sector waste workers/recyclers benefited', '4', 'Informal Sectors', '4 informal groups of waste workers integrated or supported by the project.', '4 informal groups of waste workers integrated or supported by the project.', '', 2],

    // WP 6
    ['partner', 'WP 6', 'WP 6: Financial System Enabling and Local Resource Management', 'WP 6: Financial System Enabling and Local Resource Management', 'Village waste programs receive funding allocations from the 2024 village budget (APBDes)', 'Village waste programs receive funding allocations from the 2024 village budget (APBDes)', '404.286.014', 'IDR', 'Significant funding committed by local villages from their own budgets.', 'Significant funding committed by local villages from their own budgets.', '', 1],
    ['partner', 'WP 6', 'WP 6: Financial System Enabling and Local Resource Management', 'WP 6: Financial System Enabling and Local Resource Management', 'Number of households that pay waste fee', 'Number of households that pay waste fee', '840', 'Household', '840 households regularly paying waste collection fees.', '840 households regularly paying waste collection fees.', '', 2],
    ['partner', 'WP 6', 'WP 6: Financial System Enabling and Local Resource Management', 'WP 6: Financial System Enabling and Local Resource Management', 'Jobs created in MRFs', 'Jobs created in MRFs', '113', 'People', '113 jobs created within material recovery facilities and collection services.', '113 jobs created within material recovery facilities and collection services.', '', 3],
    ['partner', 'WP 6', 'WP 6: Financial System Enabling and Local Resource Management', 'WP 6: Financial System Enabling and Local Resource Management', "Number of sub-partnership (CLOCC's Network)", "Number of sub-partnership (CLOCC's Network)", '> 25', 'Sub-Partnership', 'Extensive network of sub-partnerships within the region.', 'Extensive network of sub-partnerships within the region.', '', 4],

    // WP 7
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Number of households in pilot villages', 'Number of households in pilot villages', '6.055', 'Household', 'Total base households in the selected pilot project areas.', 'Total base households in the selected pilot project areas.', '', 1],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Population in pilot villages', 'Population in pilot villages', '19.908', 'People', 'Total population directly impacted in the pilot villages.', 'Total population directly impacted in the pilot villages.', '', 2],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Number of households served', 'Number of households served', '3.189', 'Household', 'Number of households actively using the waste collection service.', 'Number of households actively using the waste collection service.', '', 3],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Waste collected total (leakage prevented)', 'Waste collected total (leakage prevented)', '513,03', 'Tonnes', 'Total waste successfully collected and diverted from the environment.', 'Total waste successfully collected and diverted from the environment.', '', 4],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Source separation rate of collected inorganic waste (Waste Bank)', 'Source separation rate of collected inorganic waste (Waste Bank)', '2.392', 'Household', 'Participating households separating waste at the source.', 'Participating households separating waste at the source.', '', 5],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Waste recycled total (valorised)', 'Waste recycled total (valorised)', '137,3', 'Tonnes', 'Total amount of waste processed and sold/valorised.', 'Total amount of waste processed and sold/valorised.', '', 6],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Waste recycled in most recent year', 'Waste recycled in most recent year', '98,04', 'Tonnes', 'Recycling results for the previous calendar year.', 'Recycling results for the previous calendar year.', '', 7],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Recycling rate % in most recent year', 'Recycling rate % in most recent year', '26,76', '%', 'Percentage of total waste generated that was recycled.', 'Percentage of total waste generated that was recycled.', '', 8],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Organic waste recycled total', 'Organic waste recycled total', '41,09', 'Tonnes', 'Amount of organic waste turned into compost/feed.', 'Amount of organic waste turned into compost/feed.', '', 9],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Plastic waste recycled total', 'Plastic waste recycled total', '55', 'Tonnes', 'Total plastic waste captured and recycled.', 'Total plastic waste captured and recycled.', '', 10],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Paper & card recycled total', 'Paper & card recycled total', '27,01', 'Tonnes', 'Total paper and cardboard captured and recycled.', 'Total paper and cardboard captured and recycled.', '', 11],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'Metals recycled total', 'Metals recycled total', '3,3', 'Tonnes', 'Total metal waste captured and recycled.', 'Total metal waste captured and recycled.', '', 12],
    ['partner', 'WP 7', 'WP 7: Monitoring and Evaluation on Sustainability', 'WP 7: Monitoring and Evaluation on Sustainability', 'GHG emissions prevented in Pilot Villages total', 'GHG emissions prevented in Pilot Villages total', '> 161', 'Tonnes CO2eq', 'Estimated CO2 equivalent emissions avoided.', 'Estimated CO2 equivalent emissions avoided.', '', 13],

    // WP 8
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Education/behavior change events', 'Education/behavior change events', '23', 'Event', '23 community events focused on behavior change.', '23 community events focused on behavior change.', '', 1],
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Total number of individuals that have attended behavioural change events', 'Total number of individuals that have attended behavioural change events', '2.239', 'Participants', 'Across all pilot villages, 2,239 individuals reached directly.', 'Across all pilot villages, 2,239 individuals reached directly.', '', 2],
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Number of school students receiving training', 'Number of school students receiving training', '1.914', 'Students', 'Specific focus on youth and school-level environmental education.', 'Specific focus on youth and school-level environmental education.', '', 3],
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Hotspots cleared (clearing events)', 'Hotspots cleared (clearing events)', '8', 'Hotspots', 'Clean-up events resulting in removal of 8 legacy illegal dumps.', 'Clean-up events resulting in removal of 8 legacy illegal dumps.', '', 4],
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Number of schools participating in educational video campaign on waste', 'Number of schools participating in educational video campaign on waste', '45', 'School', 'Broad school involvement in digital awareness campaigns.', 'Broad school involvement in digital awareness campaigns.', '', 5],
    ['partner', 'WP 8', 'WP 8: Public Awareness and Social Engagement', 'WP 8: Public Awareness and Social Engagement', 'Public engagement through CLOCC publications on social media', 'Public engagement through CLOCC publications on social media', '169.215', 'Views', 'Digital reach across Instagram and other platforms.', 'Digital reach across Instagram and other platforms.', '', 6],

    // WP 9
    ['partner', 'WP 9', 'WP 9: Replicable Toolkits and Media Development', 'WP 9: Replicable Toolkits and Media Development', 'Number toolkits to supporting waste facility (TPS 3R/Waste Bank) optimization', 'Number toolkits to supporting waste facility (TPS 3R/Waste Bank) optimization', '584', 'Supporting Tools', '584 physical items developed to improve facility operations.', '584 physical items developed to improve facility operations.', '', 1],
    ['partner', 'WP 9', 'WP 9: Replicable Toolkits and Media Development', 'WP 9: Replicable Toolkits and Media Development', 'Number toolkits to supporting behavior change developed', 'Number toolkits to supporting behavior change developed', '> 476', 'Educational Media Materials', 'Extensive library of posters, videos, and modules.', 'Extensive library of posters, videos, and modules.', '', 2],
    ['partner', 'WP 9', 'WP 9: Replicable Toolkits and Media Development', 'WP 9: Replicable Toolkits and Media Development', 'Number of toolkits developed to support decision-making on waste management system', 'Number of toolkits developed to support decision-making on waste management system', '36', 'Toolkits', 'Methodologies and decision support tools for stakeholders.', 'Methodologies and decision support tools for stakeholders.', '', 3],


    // --- GOSIRK GREEN COMMUNITY (GGC) ---
    // Section: Main
    ['ggc', 'Main', '', '', 'Edukasi Masyarakat', 'Public Education', '300', 'People', 'Teredukasi mengenai proses pemilahan sampah serta pembuatan kompos metode menggunakan wadah Compost Bag dan eco-enzym.', 'Teredukasi mengenai proses pemilahan sampah serta pembuatan kompos metode menggunakan wadah Compost Bag dan eco-enzym.', '', 1],
    ['ggc', 'Main', '', '', 'Bibit Toga', 'Herbal Plants', '120', 'Units', 'Penanaman bibit membuka jalan bagi masyarakat untuk berkontribusi langsung pada penghijauan dan ketahanan pangan lokal.', 'Penanaman bibit membuka jalan bagi masyarakat untuk berkontribusi langsung pada penghijauan dan ketahanan pangan lokal.', '', 2],
    ['ggc', 'Main', '', '', 'Tumblr GO Sirk', 'Reusable Bottles', '106', 'Units', 'Masyarakat kini beralih ke penggunaan tumblr, mengurangi penggunaan botol plastik sekali pakai setiap bulannya.', 'Masyarakat kini beralih ke penggunaan tumblr, mengurangi penggunaan botol plastik sekali pakai setiap bulannya.', '', 3],
    ['ggc', 'Main', '', '', 'Tas Guna Ulang "Ayo Ngompos"', 'Reusable Bags', '30', 'Units', 'Mendorong masyarakat beralih ke kebiasaan belanja yang lebih ramah lingkungan dengan mengurangi penggunaan kantong belanja plastik.', 'Mendorong masyarakat beralih ke kebiasaan belanja yang lebih ramah lingkungan dengan mengurangi penggunaan kantong belanja plastik.', '', 4],

    // Section: Collapse
    ['ggc', 'Collapse', '', '', 'Pupuk Kompos (250gr)', 'Pupuk Kompos (250gr)', '107', 'Unit', 'Hasil olahan sampah organik kantor GO Sirk. Prototipe hasil praktik pengolahan sampah organik di rumah masing-masing.', 'Hasil olahan sampah organik kantor GO Sirk. Prototipe hasil praktik pengolahan sampah organik di rumah masing-masing.', '', 1],
    ['ggc', 'Collapse', '', '', 'Kompos Komunitas', 'Kompos Komunitas', '26.75', 'Kg', 'Mendorong masyarakat untuk menerapkan sirkularitas dari rumah sendiri melalui pengolahan sampah organik.', 'Mendorong masyarakat untuk menerapkan sirkularitas dari rumah sendiri melalui pengolahan sampah organik.', '', 2],
    ['ggc', 'Collapse', '', '', 'Timba Biokomposter', 'Timba Biokomposter', '7', 'Unit', 'Mandiri mengolah sampah organik menggunakan timba biokomposter, mengubah limbah dapur menjadi pupuk alami.', 'Mandiri mengolah sampah organik menggunakan timba biokomposter, mengubah limbah dapur menjadi pupuk alami.', '', 3],
    ['ggc', 'Collapse', '', '', 'Mitra Pemerintah Desa', 'Mitra Pemerintah Desa', '3', 'Instansi', 'Kolaborasi strategis dengan perangkat desa untuk mewujudkan tata kelola sampah yang legal dan terorganisir.', 'Kolaborasi strategis dengan perangkat desa untuk mewujudkan tata kelola sampah yang legal dan terorganisir.', '', 4],
    ['ggc', 'Collapse', '', '', 'Mitra Universitas', 'Mitra Universitas', '3', 'Institusi', 'Kemitraan akademik dalam riset, inovasi, dan pengabdian masyarakat untuk solusi sirkularitas yang ilmiah.', 'Kemitraan akademik dalam riset, inovasi, dan pengabdian masyarakat untuk solusi sirkularitas yang ilmiah.', '', 5],
    ['ggc', 'Collapse', '', '', 'Komunitas Penerima Manfaat', 'Komunitas Penerima Manfaat', '8', 'Komunitas', 'Kelompok masyarakat yang telah menerapkan praktik ekonomi sirkular melalui program pendampingan GGC.', 'Kelompok masyarakat yang telah menerapkan praktik ekonomi sirkular melalui program pendampingan GGC.', '', 6],
];

foreach ($impacts as $imp) {
    $db->query("INSERT INTO impact_data (page, section, section_title_id, section_title_en, label_id, label_en, value, unit, note_id, note_en, icon, order_num) 
                VALUES (:page, :section, :section_title_id, :section_title_en, :label_id, :label_en, :value, :unit, :note_id, :note_en, :icon, :order_num)");
    
    $db->bind(':page', $imp[0]);
    $db->bind(':section', $imp[1]);
    $db->bind(':section_title_id', $imp[2]);
    $db->bind(':section_title_en', $imp[3]);
    $db->bind(':label_id', $imp[4]);
    $db->bind(':label_en', $imp[5]);
    $db->bind(':value', $imp[6]);
    $db->bind(':unit', $imp[7]);
    $db->bind(':note_id', $imp[8]);
    $db->bind(':note_en', $imp[9]);
    $db->bind(':icon', $imp[10]);
    $db->bind(':order_num', $imp[11]);
    
    $db->execute();
    echo "Inserted: " . $imp[4] . " for " . $imp[0] . "\n";
}

echo "Seeding completed successfully!\n";
