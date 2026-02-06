
export const SENSE_BANK_LINK = "https://moneybox.sensebank.com.ua/?moneyboxRefillByLink&refill_id=66aedb6f-8120-4de0-af79-4090adf5fde1";
export const CONVERSION_RATE = 1.5; 
export const INTRO_AUDIO_PATH = "/assets/audio/ElevenLabs_2026-02-06T10_45_26_Artem Klopotenko - Podcast Pro_pvc_sp104_s54_sb48_v3.mp3";
export const SUPPORT_TELEGRAM = "@bortovt";

export const PACKS = [
  {
    id: 'starter',
    name: 'Стартовий',
    price: 99,
    asCoins: 150,
    benefits: ['750.000$', 'Комплект ліцензій'],
    icon: '💰'
  },
  {
    id: 'base',
    name: 'Базовий',
    price: 249,
    asCoins: 375,
    benefits: ['1.250.000$', 'Комплект ліцензій', '100% навички стрільби'],
    icon: '💎'
  },
  {
    id: 'advanced',
    name: 'Розширений',
    price: 599,
    asCoins: 900,
    benefits: ['2.000.000$', 'Макс. навички таксиста', 'Законослухняність 100%'],
    icon: '🔥'
  },
  {
    id: 'exclusive',
    name: 'Ексклюзивний',
    price: 1999,
    asCoins: 3000,
    benefits: ['14.000.000$', 'Всі навички', 'Повний пакет ліцензій'],
    icon: '👑'
  }
];

export const playSound = (type: 'click' | 'success' | 'error') => {
  const audioContext = new (window.AudioContext || (window as any).webkitAudioContext)();
  
  const playTone = (freq: number, type: OscillatorType, duration: number, volume = 0.05, delay = 0) => {
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.type = type;
    osc.frequency.setValueAtTime(freq, audioContext.currentTime + delay);
    gain.gain.setValueAtTime(volume, audioContext.currentTime + delay);
    gain.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + delay + duration);
    osc.connect(gain);
    gain.connect(audioContext.destination);
    osc.start(audioContext.currentTime + delay);
    osc.stop(audioContext.currentTime + delay + duration);
  };

  if (type === 'click') {
    playTone(800, 'sine', 0.05, 0.03);
  }
  
  if (type === 'success') {
    // iPhone Success double chime
    playTone(1046.50, 'sine', 0.3, 0.08); // C6
    playTone(1318.51, 'sine', 0.4, 0.06, 0.1); // E6
  }

  if (type === 'error') {
    // iPhone Error thud
    playTone(150, 'sine', 0.2, 0.1);
    playTone(120, 'sine', 0.2, 0.1, 0.1);
  }
};
