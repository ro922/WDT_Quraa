<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المصحف الشريف - موقع قراء</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @font-face {
            font-family: 'UthmanicHafs';
            src: url('fonts/UthmanicHafs.ttf') format('truetype');
        }

        :root {
            --primary-color: #1F4B3F;
            --secondary-color: #2C6B5B;
            --gold-color: #D4AF37;
            --text-color: #333333;
            --border-color: #dee2e6;
            --background-light: #f8f9fa;
            --background-white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Traditional Arabic', Arial, sans-serif;
            background-color: var(--background-light);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-color);
        }

        /* Header Styles */
        .site-header {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1000;
        }

        .main-nav {
            background-color: var(--primary-color);
            padding: 15px 0;
            border-bottom: 3px solid var(--gold-color);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            color: white;
            text-decoration: none;
            font-size: 28px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--gold-color);
            font-size: 32px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 16px;
            font-weight: 500;
        }

        .nav-links a:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .nav-links a.active {
            background-color: var(--secondary-color);
            color: var(--gold-color);
        }

        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .nav-links a {
                padding: 6px 12px;
                font-size: 14px;
            }
        }

        /* Main Content */
        .main-container {
            display: flex;
            min-height: 100vh;
            padding-top: 116px;
            background: url('https://img.freepik.com/free-photo/3d-ramadan-celebration-with-castle_23-2151259883.jpg?semt=ais_hybrid&w=740') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 300px;
            background-color: rgba(31, 75, 63, 0.85);
            padding: 20px;
            height: 100vh;
            position: fixed;
            right: 0;
            top: 90px;
            /* بدلاً من 116 */
            height: calc(100vh - 90px);
            overflow-y: auto;
            backdrop-filter: blur(5px);
        }

        .search-container {
            position: relative;
            margin-bottom: 20px;
        }

        .search-box {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .search-box::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .search-box:focus {
            outline: none;
            border-color: var(--gold-color);
            background-color: rgba(255, 255, 255, 0.15);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 60%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
        }

        .zoom-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .zoom-btn {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: white;
        }

        .zoom-btn:hover {
            background-color: var(--gold-color);
            border-color: var(--gold-color);
        }

        .sura-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            padding: 20px;
            list-style: none;
            max-height: 80vh;
            overflow-y: auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            scroll-behavior: smooth;
        }

        .sura-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #ffffff;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            position: relative;
        }

        .sura-item.active {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .sura-item.active .sura-name,
        .sura-item.active .sura-number {
            color: white;
        }

        .sura-item.active .sura-number {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .sura-number {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 50%;
            margin-left: 10px;
            font-weight: bold;
            color: #333;
            border: 1px solid #dee2e6;
        }

        .sura-name {
            font-size: 16px;
            color: #333;
            font-weight: 500;
            flex-grow: 1;
            text-align: right;
        }

        .sura-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background: var(--primary-color);
        }

        .sura-item:hover .sura-name,
        .sura-item:hover .sura-number {
            color: white;
        }

        .sura-item:hover .sura-number {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Quran Content Styles */
        .quran-container {
            flex: 1;
            margin-right: 300px;
            padding: 30px 40px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            min-height: calc(100vh - 116px);
        }

        .surah-title {
            font-size: 45px;
            text-align: center;
            margin-bottom: 30px;
            color: var(--gold-color);
            font-family: 'UthmanicHafs', 'Traditional Arabic', Arial, sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        .bismillah {
            text-align: center;
            font-size: 40px;
            margin: 30px 0;
            color: var(--gold-color);
            font-family: 'UthmanicHafs', 'Traditional Arabic', Arial, sans-serif;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        /* تصميم جديد للآيات يشبه المصحف */
        .ayah-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            position: relative;
            line-height: 3;
            text-align: justify;
            font-family: 'UthmanicHafs', 'Traditional Arabic', Arial, sans-serif;
            font-size: 28px;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .ayah {
            display: inline;
            margin-left: 10px;
            line-height: 2.5;
        }

        .ayah-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background-color: #f8f9fa;
            border: 1px solid var(--gold-color);
            color: var(--gold-color);
            border-radius: 50%;
            margin: 0 5px;
            font-size: 16px;
            font-family: Arial, sans-serif;
        }


        .ayah-number:hover {
            background-color: var(--gold-color);
            color: white;
        }

        .error {
            color: red;
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="main-nav">
            <div class="nav-container">
                <a href="index.php" class="logo">
                    <i class="fas fa-quran"></i>
                    قراء
                </a>
                <ul class="nav-links">
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="quran.php" class="active">المصحف</a></li>
                    <li><a href="azkar.php">الأذكار</a></li>
                    <li><a href="tafseer.php">التفسير</a></li>
                    <li><a href="recitations.html">القراء</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="main-container">
        <div class="sidebar">
            <div class="search-container">
                <input type="text" class="search-box" placeholder="ابحث عن سورة...">
                <i class="fas fa-search search-icon"></i>
            </div>
            <div class="zoom-controls">
                <button class="zoom-btn" title="تصغير"><i class="fas fa-minus"></i></button>
                <button class="zoom-btn" title="تكبير"><i class="fas fa-plus"></i></button>
            </div>
            <ul class="sura-list">
                <?php
                $surahNames = array(
                    "1" => "الفاتحة",
                    "2" => "البقرة",
                    "3" => "آل عمران",
                    "4" => "النساء",
                    "5" => "المائدة",
                    "6" => "الأنعام",
                    "7" => "الأعراف",
                    "8" => "الأنفال",
                    "9" => "التوبة",
                    "10" => "يونس",
                    "11" => "هود",
                    "12" => "يوسف",
                    "13" => "الرعد",
                    "14" => "إبراهيم",
                    "15" => "الحجر",
                    "16" => "النحل",
                    "17" => "الإسراء",
                    "18" => "الكهف",
                    "19" => "مريم",
                    "20" => "طه",
                    "21" => "الأنبياء",
                    "22" => "الحج",
                    "23" => "المؤمنون",
                    "24" => "النور",
                    "25" => "الفرقان",
                    "26" => "الشعراء",
                    "27" => "النمل",
                    "28" => "القصص",
                    "29" => "العنكبوت",
                    "30" => "الروم",
                    "31" => "لقمان",
                    "32" => "السجدة",
                    "33" => "الأحزاب",
                    "34" => "سبأ",
                    "35" => "فاطر",
                    "36" => "يس",
                    "37" => "الصافات",
                    "38" => "ص",
                    "39" => "الزمر",
                    "40" => "غافر",
                    "41" => "فصلت",
                    "42" => "الشورى",
                    "43" => "الزخرف",
                    "44" => "الدخان",
                    "45" => "الجاثية",
                    "46" => "الأحقاف",
                    "47" => "محمد",
                    "48" => "الفتح",
                    "49" => "الحجرات",
                    "50" => "ق",
                    "51" => "الذاريات",
                    "52" => "الطور",
                    "53" => "النجم",
                    "54" => "القمر",
                    "55" => "الرحمن",
                    "56" => "الواقعة",
                    "57" => "الحديد",
                    "58" => "المجادلة",
                    "59" => "الحشر",
                    "60" => "الممتحنة",
                    "61" => "الصف",
                    "62" => "الجمعة",
                    "63" => "المنافقون",
                    "64" => "التغابن",
                    "65" => "الطلاق",
                    "66" => "التحريم",
                    "67" => "الملك",
                    "68" => "القلم",
                    "69" => "الحاقة",
                    "70" => "المعارج",
                    "71" => "نوح",
                    "72" => "الجن",
                    "73" => "المزمل",
                    "74" => "المدثر",
                    "75" => "القيامة",
                    "76" => "الإنسان",
                    "77" => "المرسلات",
                    "78" => "النبأ",
                    "79" => "النازعات",
                    "80" => "عبس",
                    "81" => "التكوير",
                    "82" => "الانفطار",
                    "83" => "المطففين",
                    "84" => "الانشقاق",
                    "85" => "البروج",
                    "86" => "الطارق",
                    "87" => "الأعلى",
                    "88" => "الغاشية",
                    "89" => "الفجر",
                    "90" => "البلد",
                    "91" => "الشمس",
                    "92" => "الليل",
                    "93" => "الضحى",
                    "94" => "الشرح",
                    "95" => "التين",
                    "96" => "العلق",
                    "97" => "القدر",
                    "98" => "البينة",
                    "99" => "الزلزلة",
                    "100" => "العاديات",
                    "101" => "القارعة",
                    "102" => "التكاثر",
                    "103" => "العصر",
                    "104" => "الهمزة",
                    "105" => "الفيل",
                    "106" => "قريش",
                    "107" => "الماعون",
                    "108" => "الكوثر",
                    "109" => "الكافرون",
                    "110" => "النصر",
                    "111" => "المسد",
                    "112" => "الإخلاص",
                    "113" => "الفلق",
                    "114" => "الناس"
                );
                foreach ($surahNames as $number => $name) {
                    echo '<li class="sura-item" data-surah="' . $number . '">';
                    echo '<span class="sura-number">' . $number . '</span>';
                    echo '<span class="sura-name">سورة ' . $name . '</span>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>

        <div class="quran-container">
            <div id="surahContent">
                <?php
                if (file_exists('quran.json')) {
                    $jsonFile = file_get_contents('quran.json');
                    if ($jsonFile !== false) {
                        $quranData = json_decode($jsonFile, true);
                        if ($quranData !== null) {
                            $firstSurah = $quranData["1"];
                            echo '<h1 class="surah-title">سورة الفاتحة</h1>';
                            echo '<div class="bismillah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>';
                            echo '<div class="ayah-container">';

                            foreach ($firstSurah as $verse) {
                                echo '<span class="ayah">';
                                echo $verse['text'];
                                echo '<span class="ayah-number">' . $verse['verse'] . '</span>';
                                echo '</span>';
                            }

                            echo '</div>';
                        } else {
                            echo '<div class="error">خطأ في تنسيق ملف القرآن</div>';
                        }
                    } else {
                        echo '<div class="error">خطأ في قراءة ملف القرآن</div>';
                    }
                } else {
                    echo '<div class="error">ملف القرآن غير موجود</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- مشغل الصوت -->
    <div class="audio-player" id="audioPlayer" style="display: none;">
        <div class="audio-info" id="audioInfo">جارٍ تحميل السورة...</div>
        <div class="audio-controls">
            <button class="audio-btn" id="prevAyah"><i class="fas fa-step-backward"></i></button>
            <button class="audio-btn" id="playPauseBtn"><i class="fas fa-play"></i></button>
            <button class="audio-btn" id="nextAyah"><i class="fas fa-step-forward"></i></button>
        </div>
        <div class="audio-progress" id="audioProgress">
            <div class="audio-progress-filled" id="audioProgressFilled"></div>
        </div>
    </div>

    <script>
        // تهيئة المتغيرات
        const zoomBtns = document.querySelectorAll('.zoom-btn');
        const searchBox = document.querySelector('.search-box');
        const suraItems = document.querySelectorAll('.sura-item');
        let currentSize = 28;
        let currentSurah = 1;
        let currentAyah = 1;
        let audioPlayer = new Audio();
        let isPlaying = false;

        // وظيفة تكبير وتصغير النص
        zoomBtns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                if (index === 1 && currentSize < 40) { // زر التكبير
                    currentSize += 2;
                } else if (index === 0 && currentSize > 20) { // زر التصغير
                    currentSize -= 2;
                }
                document.querySelectorAll('.ayah-container').forEach(container => {
                    container.style.fontSize = currentSize + 'px';
                });
            });
        });

        // وظيفة البحث
        searchBox.addEventListener('input', (e) => {
            const searchText = e.target.value.trim();
            suraItems.forEach(item => {
                const suraName = item.querySelector('.sura-name').textContent;
                if (suraName.includes(searchText)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // وظيفة تحميل السورة
        suraItems.forEach(item => {
            item.addEventListener('click', async () => {
                try {
                    const surahNumber = item.dataset.surah;
                    currentSurah = surahNumber;
                    currentAyah = 1;

                    // إزالة الصنف النشط من جميع السور
                    suraItems.forEach(si => si.classList.remove('active'));
                    // إضافة الصنف النشط للسورة المحددة
                    item.classList.add('active');

                    // تمرير السورة المحددة إلى منتصف القائمة
                    const suraList = document.querySelector('.sura-list');
                    const itemRect = item.getBoundingClientRect();
                    const listRect = suraList.getBoundingClientRect();
                    const scrollTop = item.offsetTop - (listRect.height / 2) + (itemRect.height / 2);
                    suraList.scrollTo({
                        top: scrollTop,
                        behavior: 'smooth'
                    });

                    const response = await fetch('quran.json');
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const quranData = await response.json();
                    const surahData = quranData[surahNumber];

                    if (surahData) {
                        const surahName = item.querySelector('.sura-name').textContent;
                        let html = `<h1 class="surah-title">${surahName}</h1>`;

                        if (surahNumber !== "9") {
                            html += `<div class="bismillah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>`;
                        }

                        html += `<div class="ayah-container" style="font-size: ${currentSize}px">`;

                        surahData.forEach(verse => {
                            html += `<span class="ayah">
                                ${verse.text}
                                <span class="ayah-number">${verse.verse}</span>
                            </span>`;
                        });

                        html += `</div>`;

                        document.getElementById('surahContent').innerHTML = html;

                        // تمرير إلى أعلى الصفحة
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        // إعداد مشغل الصوت
                        setupAudioPlayer(surahNumber, surahName);
                    }
                } catch (error) {
                    console.error('Error loading surah:', error);
                    document.getElementById('surahContent').innerHTML = `
                        <div class="error" style="text-align: center; color: red; padding: 20px;">
                            عذراً، حدث خطأ أثناء تحميل السورة. الرجاء المحاولة مرة أخرى.
                        </div>`;
                }
            });
        });

        // وظيفة إعداد مشغل الصوت
        function setupAudioPlayer(surahNumber, surahName) {
            // إظهار مشغل الصوت
            document.getElementById('audioPlayer').style.display = 'flex';
            document.getElementById('audioInfo').textContent = `سورة ${surahName.split('سورة ')[1]} - الآية 1`;

            // إعداد مصدر الصوت (هنا نستخدم خدمة قرآن كريم)
            audioPlayer.src = `https://server.mp3quran.net/shatri/${surahNumber}.mp3`;

            // إعادة تعيين حالة التشغيل
            isPlaying = false;
            document.getElementById('playPauseBtn').innerHTML = '<i class="fas fa-play"></i>';

            // إعادة تعيين شريط التقدم
            document.getElementById('audioProgressFilled').style.width = '0%';
        }

        // التحكم في مشغل الصوت
        document.getElementById('playPauseBtn').addEventListener('click', () => {
            if (isPlaying) {
                audioPlayer.pause();
                document.getElementById('playPauseBtn').innerHTML = '<i class="fas fa-play"></i>';
            } else {
                audioPlayer.play();
                document.getElementById('playPauseBtn').innerHTML = '<i class="fas fa-pause"></i>';
            }
            isPlaying = !isPlaying;
        });

        // تحديث شريط التقدم
        audioPlayer.addEventListener('timeupdate', () => {
            const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            document.getElementById('audioProgressFilled').style.width = `${progress}%`;
        });

        // النقر على شريط التقدم لتغيير الموضع
        document.getElementById('audioProgress').addEventListener('click', (e) => {
            const progressBar = document.getElementById('audioProgress');
            const clickPosition = e.clientX - progressBar.getBoundingClientRect().left;
            const progressBarWidth = progressBar.clientWidth;
            const seekTime = (clickPosition / progressBarWidth) * audioPlayer.duration;
            audioPlayer.currentTime = seekTime;
        });

        // عند انتهاء التشغيل
        audioPlayer.addEventListener('ended', () => {
            document.getElementById('playPauseBtn').innerHTML = '<i class="fas fa-play"></i>';
            isPlaying = false;
        });

        // تحميل السورة الأولى عند فتح الصفحة
        window.addEventListener('DOMContentLoaded', () => {
            setupAudioPlayer(1, "سورة الفاتحة");
        });
    </script>
</body>

</html>