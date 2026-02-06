
export const SENSE_BANK_LINK = "https://moneybox.sensebank.com.ua/?moneyboxRefillByLink&refill_id=66aedb6f-8120-4de0-af79-4090adf5fde1";
export const CONVERSION_RATE = 1.5; // 1 UAH = 1.5 AS Coins (як просили: 2 грн = 3 коіна)

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

export const playSound = (type: 'click' | 'success') => {
  const audioContext = new (window.AudioContext || (window as any).webkitAudioContext)();
  const playTone = (freq: number, type: OscillatorType, duration: number) => {
    const osc = audioContext.createOscillator();
    const gain = audioContext.createGain();
    osc.type = type;
    osc.frequency.setValueAtTime(freq, audioContext.currentTime);
    gain.gain.setValueAtTime(0.05, audioContext.currentTime);
    gain.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + duration);
    osc.connect(gain);
    gain.connect(audioContext.destination);
    osc.start();
    osc.stop(audioContext.currentTime + duration);
  };

  if (type === 'click') playTone(600, 'sine', 0.1);
  if (type === 'success') {
    playTone(500, 'sine', 0.2);
    setTimeout(() => playTone(800, 'sine', 0.3), 100);
  }
};
