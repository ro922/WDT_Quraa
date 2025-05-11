let verses = [];
let currentIndex = 0;
let recognizer = null;
let isListening = false;
let attempts = 0;
const MAX_ATTEMPTS = 3;
let isProcessing = false;

fetch('quran.json')
  .then(res => res.json())
  .then(data => {
    verses = data["1"];
    displayVerse();
    initRecognizer();
  })
  .catch(error => {
    console.error('خطأ في تحميل الآيات:', error);
    alert('حدث خطأ في تحميل الآيات. يرجى تحديث الصفحة.');
  });

function displayVerse() {
  const ayahText = document.getElementById('ayah-text');
  const ayahNumber = document.getElementById('ayah-number');
  const progress = document.getElementById('progress');
  
  ayahText.textContent = verses[currentIndex].text;
  ayahNumber.textContent = `الآية ${currentIndex + 1} من ${verses.length}`;
  progress.textContent = `التقدم: ${Math.round((currentIndex / verses.length) * 100)}%`;
  
  attempts = 0;
  updateAttemptsDisplay();
  isProcessing = false;
}

function initRecognizer() {
  if (!('webkitSpeechRecognition' in window)) {
    alert("عذراً، المتصفح لا يدعم التعرف على الصوت. يرجى استخدام متصفح حديث مثل Chrome");
    return;
  }

  recognizer = new webkitSpeechRecognition();
  recognizer.lang = 'ar-SA';
  recognizer.continuous = false;
  recognizer.interimResults = false;

  recognizer.onstart = () => {
    isListening = true;
    updateListeningStatus(true);
  };

  recognizer.onend = () => {
    isListening = false;
    updateListeningStatus(false);
    
    if (!isProcessing) {
      setTimeout(() => {
        if (!isListening) {
          recognizer = new webkitSpeechRecognition();
          recognizer.lang = 'ar-SA';
          recognizer.continuous = false;
          recognizer.interimResults = false;
          setupRecognizerEvents();
        }
      }, 100);
    }
  };

  setupRecognizerEvents();
}

function setupRecognizerEvents() {
  recognizer.onresult = (event) => {
    if (isProcessing) return;
    isProcessing = true;

    try {
      const spoken = normalize(event.results[0][0].transcript);
      const actual = normalize(verses[currentIndex].text);
      const score = similarity(spoken, actual);
      
      document.getElementById('result').textContent = `نسبة التشابه: ${(score * 100).toFixed(1)}%`;
      
      if (score > 0.4) {
        showSuccess();
        setTimeout(() => {
          currentIndex++;
          if (currentIndex < verses.length) {
            displayVerse();
          } else {
            showCompletion();
          }
        }, 1500);
      } else {
        attempts++;
        updateAttemptsDisplay();
        
        if (attempts >= MAX_ATTEMPTS) {
          showHint();
          document.getElementById('spoken-text').textContent = `ما قرأته: ${spoken}`;
          document.getElementById('correct-text').textContent = `النص الصحيح: ${actual}`;
        } else {
          showError('حاول مرة أخرى، ركز على النطق الصحيح');
        }
      }
    } catch (error) {
      console.error('خطأ في معالجة النتيجة:', error);
      showError('حدث خطأ في معالجة النتيجة. يرجى المحاولة مرة أخرى.');
    } finally {
      isProcessing = false;
    }
  };

  recognizer.onerror = (e) => {
    console.error('خطأ في التعرف على الصوت:', e);
    isProcessing = false;
    showError('حدث خطأ في التعرف على الصوت. يرجى المحاولة مرة أخرى.');
    
    setTimeout(() => {
      if (!isListening) {
        recognizer = new webkitSpeechRecognition();
        recognizer.lang = 'ar-SA';
        recognizer.continuous = false;
        recognizer.interimResults = false;
        setupRecognizerEvents();
      }
    }, 1000);
  };
}

function startListening() {
  if (!isListening && !isProcessing) {
    try {
      recognizer.start();
    } catch (error) {
      console.error('خطأ في بدء التعرف على الصوت:', error);
      recognizer = new webkitSpeechRecognition();
      recognizer.lang = 'ar-SA';
      recognizer.continuous = false;
      recognizer.interimResults = false;
      setupRecognizerEvents();
      recognizer.start();
    }
  }
}

function updateListeningStatus(listening) {
  const button = document.getElementById('record-button');
  if (listening) {
    button.textContent = 'جاري الاستماع...';
    button.classList.add('listening');
  } else {
    button.textContent = 'ابدأ القراءة';
    button.classList.remove('listening');
  }
}

function updateAttemptsDisplay() {
  const attemptsDisplay = document.getElementById('attempts');
  attemptsDisplay.textContent = `المحاولات: ${attempts}/${MAX_ATTEMPTS}`;
}

function showSuccess() {
  const result = document.getElementById('result');
  result.textContent = 'أحسنت! ✅';
  result.classList.add('success');
  setTimeout(() => result.classList.remove('success'), 1500);
}

function showError(message = 'حاول مرة أخرى!') {
  const result = document.getElementById('result');
  result.textContent = message;
  result.classList.add('error');
  setTimeout(() => result.classList.remove('error'), 1500);
}

function showHint() {
  const hint = document.getElementById('hint');
  hint.textContent = 'تلميح: حاول قراءة الآية ببطء ووضوح، وركز على نطق الحروف بشكل صحيح';
  hint.style.display = 'block';
  setTimeout(() => hint.style.display = 'none', 3000);
}

function showCompletion() {
  const ayahText = document.getElementById('ayah-text');
  ayahText.textContent = "أحسنت! لقد أكملت قراءة جميع الآيات ✅";
  ayahText.classList.add('completion');
}

function normalize(text) {
  return text
    .replace(/[^\u0621-\u064A\s]/g, '')
    .replace(/\s+/g, ' ')
    .replace(/أ|إ|آ|ء|ع/g, 'ا')
    .replace(/ى|ئ|ي/g, 'ي')
    .replace(/ة|ه/g, 'ه')
    .replace(/ؤ|و/g, 'و')
    .replace(/ص|س/g, 'س')
    .replace(/ض|د/g, 'د')
    .replace(/ط|ت|ث/g, 'ت')
    .replace(/ظ|ز|ذ/g, 'ز')
    .replace(/ق|ك|غ/g, 'ك')
    .replace(/خ|ح/g, 'ح')
    .replace(/ب|پ/g, 'ب')
    .replace(/ج|چ/g, 'ج')
    .replace(/ف|ڤ/g, 'ف')
    .replace(/ر|ز/g, 'ر')
    .replace(/ن|م/g, 'ن')
    .trim();
}

function similarity(a, b) {
  const wordsA = a.split(/\s+/);
  const wordsB = b.split(/\s+/);
  
  let totalScore = 0;
  let matchedWords = new Set();
  
  for (const wordA of wordsA) {
    let bestScore = 0;
    let bestMatch = null;
    
    for (const wordB of wordsB) {
      if (!matchedWords.has(wordB)) {
        const score = wordSimilarity(wordA, wordB);
        if (score > bestScore) {
          bestScore = score;
          bestMatch = wordB;
        }
      }
    }
    
    if (bestMatch) {
      matchedWords.add(bestMatch);
      totalScore += bestScore;
    }
  }
  
  const totalWords = Math.max(wordsA.length, wordsB.length);
  return totalScore / totalWords;
}

function wordSimilarity(word1, word2) {
  if (word1 === word2) return 1.0;
  
  if (word1.includes(word2) || word2.includes(word1)) {
    return 0.95;
  }
  
  if (word1.startsWith(word2.substring(0, 2)) || 
      word2.startsWith(word1.substring(0, 2)) ||
      word1.endsWith(word2.slice(-2)) || 
      word2.endsWith(word1.slice(-2))) {
    return 0.9;
  }
  
  const distance = editDistance(word1, word2);
  const maxLength = Math.max(word1.length, word2.length);
  
  if (distance <= 4) {
    return 1 - (distance / (maxLength * 2));
  }
  
  return 0;
}

function editDistance(s1, s2) {
  const costs = Array(s2.length + 1).fill(0).map((_, i) => i);
  for (let i = 1; i <= s1.length; i++) {
    let prev = i;
    for (let j = 1; j <= s2.length; j++) {
      const tmp = costs[j];
      const cost = s1[i - 1] === s2[j - 1] ? 0 : 
                  (isCommonMistake(s1[i - 1], s2[j - 1]) ? 0.2 : 0.5);
      costs[j] = Math.min(
        costs[j - 1] + cost,
        costs[j] + cost,
        prev + cost
      );
      prev = tmp;
    }
  }
  return costs[s2.length];
}

function isCommonMistake(char1, char2) {
  const commonMistakes = {
    'ا': ['أ', 'إ', 'آ', 'ء', 'ع'],
    'ي': ['ى', 'ئ'],
    'ه': ['ة'],
    'و': ['ؤ'],
    'س': ['ص'],
    'ز': ['ذ', 'ظ'],
    'ت': ['ط', 'ث'],
    'د': ['ض'],
    'ك': ['ق', 'غ'],
    'ح': ['خ'],
    'ب': ['پ'],
    'ج': ['چ'],
    'ف': ['ڤ'],
    'ر': ['ز'],
    'ن': ['م']
  };
  
  return (commonMistakes[char1] && commonMistakes[char1].includes(char2)) ||
         (commonMistakes[char2] && commonMistakes[char2].includes(char1));
}

const style = document.createElement('style');
style.textContent = `
  .success { color: #28a745; }
  .error { color: #dc3545; }
  .completion { 
    color: #28a745;
    font-size: 1.2em;
    text-align: center;
  }
  .listening {
    background-color: #dc3545;
    color: white;
  }
  #hint {
    color: #ffc107;
    margin-top: 10px;
    display: none;
  }
`;
document.head.appendChild(style);
