
import React, { useState, useEffect, useRef } from 'react';
import { DonationStep } from './types';
import { PACKS, CONVERSION_RATE, playSound, SENSE_BANK_LINK, INTRO_AUDIO_PATH, SUPPORT_TELEGRAM } from './constants';

const UAH_TO_USD = 41.25; 

const INTRO_TEXT_PARTS = [
  "Вітаємо! Ви потрапили на сторінку донату Aspect Role Play.",
  "Звертаємо вашу увагу: це єдиний офіційний ресурс для поповнення ігрового рахунку.",
  "Під час оплати, будь ласка, уважно читайте вказівки.",
  "У разі, якщо кошти було списано, але валюта не надійшла протягом двадцяти хвилин — зверніться у технічну підтримку.",
  "Обов'язково додайте доказ оплати: квитанцію, де чітко видно час, дату, суму та реквізити отримувача.",
  "Дякуємо, що ви з нами. На все добре! Команда Aspect Role Play."
];

const App: React.FC = () => {
  const [isIntroActive, setIsIntroActive] = useState(true);
  const [introStarted, setIntroStarted] = useState(false);
  const [currentIntroPart, setCurrentIntroPart] = useState(0);
  const [nickname, setNickname] = useState('');
  const [amountUah, setAmountUah] = useState<string>('');
  const [selectedServer, setSelectedServer] = useState('Aspect RP #1');
  const [showModal, setShowModal] = useState<null | DonationStep>(null);
  const [paymentView, setPaymentView] = useState<'methods' | 'paypal' | 'ua_bank'>('methods');
  const [paymentStatus, setPaymentStatus] = useState<'pending' | 'checking' | 'success' | 'not_paid' | 'error'>('pending');
  const [isPaypalLoading, setIsPaypalLoading] = useState(false);
  const [isPaypalVerified, setIsPaypalVerified] = useState(false);
  const [receiptFile, setReceiptFile] = useState<File | null>(null);
  
  const introAudioRef = useRef<HTMLAudioElement | null>(null);
  const paypalScriptInjected = useRef(false);

  const asCoins = amountUah ? Math.floor(Number(amountUah) * CONVERSION_RATE) : 0;
  const amountUsd = amountUah ? (Number(amountUah) / UAH_TO_USD).toFixed(2) : "0.00";

  // PayPal Dynamic Amount Loader
  useEffect(() => {
    if (showModal === DonationStep.PAYMENT && paymentView === 'paypal' && !paypalScriptInjected.current) {
      setIsPaypalLoading(true);
      const script = document.createElement('script');
      // Використовуємо стандартний SDK замість hosted-buttons для динамічної суми
      script.src = "https://www.paypal.com/sdk/js?client-id=BAAazVFq-vV3T9mfV87J1p-VKd8-lGoxHvCSmbNENHUbI_gML7_jqBkZAKjWULxFtTQvX5D2vZ5KUpI6y0&currency=USD&disable-funding=venmo";
      script.async = true;
      script.onload = () => {
        paypalScriptInjected.current = true;
        renderDynamicPaypal();
      };
      script.onerror = () => setIsPaypalLoading(false);
      document.body.appendChild(script);
    } else if (showModal === DonationStep.PAYMENT && paymentView === 'paypal') {
      renderDynamicPaypal();
    }
  }, [showModal, paymentView, amountUsd]);

  const renderDynamicPaypal = () => {
    setIsPaypalLoading(true);
    const checkPaypal = setInterval(() => {
      const paypal = (window as any).paypal;
      if (paypal && paypal.Buttons) {
        clearInterval(checkPaypal);
        const container = document.getElementById("paypal-button-container");
        if (container) {
          container.innerHTML = "";
          try {
            paypal.Buttons({
              createOrder: (data: any, actions: any) => {
                return actions.order.create({
                  purchase_units: [{
                    amount: {
                      value: amountUsd
                    },
                    description: `Aspect RP Donation: ${nickname} (${asCoins} AS Coins)`
                  }]
                });
              },
              onApprove: (data: any, actions: any) => {
                return actions.order.capture().then((details: any) => {
                  setIsPaypalVerified(true);
                  playSound('success');
                });
              },
              onCancel: () => playSound('error'),
              onError: (err: any) => {
                console.error("PayPal Error", err);
                setIsPaypalLoading(false);
              }
            }).render("#paypal-button-container")
            .then(() => setIsPaypalLoading(false));
          } catch (e) {
            setIsPaypalLoading(false);
          }
        }
      }
    }, 500);
  };

  const startIntro = () => {
    setIntroStarted(true);
    if (introAudioRef.current) {
      introAudioRef.current.play().catch(err => {
        console.warn("Autoplay blocked. Pressing skip if needed.", err);
      });
    }
  };

  useEffect(() => {
    if (introStarted) {
      const interval = setInterval(() => {
        setCurrentIntroPart(prev => {
          if (prev < INTRO_TEXT_PARTS.length - 1) return prev + 1;
          return prev;
        });
      }, 5500); 
      return () => clearInterval(interval);
    }
  }, [introStarted]);

  const handleIntroEnd = () => {
    setIsIntroActive(false);
    playSound('click');
  };

  const handlePay = () => {
    if (!nickname || !amountUah || Number(amountUah) < 1) return;
    playSound('click');
    setPaymentStatus('pending');
    setPaymentView('methods');
    setIsPaypalVerified(false);
    setReceiptFile(null);
    setShowModal(DonationStep.PAYMENT);
  };

  const handleVerifyManual = () => {
    if (paymentView === 'paypal' && !isPaypalVerified) {
        setPaymentStatus('not_paid');
        playSound('error');
        setTimeout(() => setPaymentStatus('pending'), 3000);
        return;
    }
    if (paymentView === 'ua_bank' && !receiptFile) {
        setPaymentStatus('not_paid');
        playSound('error');
        setTimeout(() => setPaymentStatus('pending'), 3000);
        return;
    }

    setPaymentStatus('checking');
    playSound('click');
    setTimeout(() => {
      setPaymentStatus('success');
      playSound('success');
      setTimeout(() => setShowModal(DonationStep.SUCCESS), 1500);
    }, 4000);
  };

  const onFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
        setReceiptFile(e.target.files[0]);
    }
  };

  if (isIntroActive) {
    return (
      <div className="fixed inset-0 z-[200] bg-black flex flex-col items-center justify-center p-8 overflow-hidden">
        <audio 
          ref={introAudioRef} 
          src={INTRO_AUDIO_PATH} 
          onEnded={handleIntroEnd}
          onError={() => console.warn("Audio file missing")}
        />
        
        {!introStarted ? (
          <div className="text-center space-y-8 animate-slide-up">
            <div className="w-24 h-24 bg-red-600 rounded-3xl flex items-center justify-center mx-auto mb-10 shadow-[0_0_50px_rgba(220,38,38,0.5)]">
              <span className="text-5xl font-black italic text-white">A</span>
            </div>
            <h1 className="text-3xl font-black text-white uppercase italic tracking-tighter">Aspect Donate</h1>
            <p className="text-gray-500 text-sm font-bold uppercase tracking-widest">Прослухайте важливу інформацію</p>
            <button 
              onClick={startIntro}
              className="px-12 py-5 bg-white text-black font-black uppercase text-xs tracking-[0.3em] rounded-2xl hover:bg-red-600 hover:text-white transition-all shadow-2xl active:scale-95"
            >
              Увійти
            </button>
          </div>
        ) : (
          <div className="w-full max-w-4xl space-y-12 text-center flex flex-col items-center justify-center">
             <div className="flex justify-center gap-2 mb-20">
               {INTRO_TEXT_PARTS.map((_, i) => (
                 <div key={i} className={`h-1 rounded-full transition-all duration-1000 ${i <= currentIntroPart ? 'w-12 bg-red-600' : 'w-4 bg-white/10'}`}></div>
               ))}
             </div>
             
             <div className="min-h-[300px] w-full flex items-center justify-center relative">
               {INTRO_TEXT_PARTS.map((text, i) => (
                 i === currentIntroPart && (
                   <p key={i} className="absolute inset-0 text-2xl md:text-4xl font-black text-white italic uppercase tracking-tighter leading-tight fade-in-text">
                     {text}
                   </p>
                 )
               ))}
             </div>

             <div className="pt-20">
               <p className="text-gray-600 text-[10px] font-bold uppercase tracking-[0.5em] animate-pulse">Голосова інструкція...</p>
               <button onClick={handleIntroEnd} className="mt-12 text-white/30 hover:text-white text-[9px] uppercase font-black tracking-widest transition-colors">Пропустити та увійти</button>
             </div>
          </div>
        )}
      </div>
    );
  }

  return (
    <div className="flex flex-col min-h-screen">
      {/* Header */}
      <nav className="w-full h-20 px-4 lg:px-24 flex items-center justify-between z-50 bg-black/40 backdrop-blur-md border-b border-white/5">
        <div className="flex items-center gap-3">
          <div className="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center font-black text-xl italic">A</div>
          <div className="flex flex-col leading-none">
            <span className="font-black text-lg tracking-tighter text-white">ASPECT</span>
            <span className="text-[8px] text-red-500 font-bold tracking-widest uppercase">Role Play</span>
          </div>
        </div>
        <div className="flex items-center gap-4">
            <div className="hidden sm:flex items-center gap-3 bg-white/5 px-4 py-1.5 rounded-full border border-white/5">
                <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span className="text-[10px] font-bold uppercase text-gray-400">Server Online</span>
            </div>
            <a href={`https://t.me/${SUPPORT_TELEGRAM.replace('@','')}`} target="_blank" className="text-[9px] font-black text-white/40 uppercase hover:text-blue-400 transition-colors">Підтримка</a>
        </div>
      </nav>

      {/* Main Content */}
      <main className="flex-1 w-full max-w-7xl mx-auto px-4 lg:px-8 py-8 flex flex-col lg:flex-row gap-8 items-start">
        <section className="w-full lg:w-[420px] shrink-0 animate-slide-up">
          <div className="evolve-panel p-6 lg:p-8 space-y-6 shadow-2xl relative border-t-2 border-red-600">
            <div className="space-y-1">
                <h2 className="text-2xl font-black uppercase italic text-white">Донат-рахунок</h2>
                <p className="text-gray-500 text-[9px] font-bold uppercase tracking-widest">Купівля AS Coins • Курс 1:{CONVERSION_RATE}</p>
            </div>

            <div className="space-y-4">
              <div className="space-y-2">
                <label className="text-[10px] font-bold uppercase text-gray-500 ml-1">Сервер</label>
                <select className="w-full evolve-input p-4 rounded-xl text-sm outline-none cursor-pointer" value={selectedServer} onChange={(e) => setSelectedServer(e.target.value)}>
                    <option>Aspect RP #1</option>
                    <option>Aspect RP #2</option>
                </select>
              </div>

              <div className="space-y-2">
                <label className="text-[10px] font-bold uppercase text-gray-500 ml-1">Ігровий нікнейм</label>
                <input type="text" placeholder="Artem_Procko" className="w-full evolve-input p-4 rounded-xl text-sm outline-none" value={nickname} onChange={(e) => setNickname(e.target.value)} />
              </div>

              <div className="space-y-2">
                <label className="text-[10px] font-bold uppercase text-gray-500 ml-1">Сума (UAH)</label>
                <input type="number" placeholder="Напр. 100" className="w-full evolve-input p-4 rounded-xl text-sm outline-none" value={amountUah} onChange={(e) => setAmountUah(e.target.value)} />
              </div>

              <div className="bg-red-600/10 rounded-2xl p-5 border border-red-600/20 flex items-center justify-between">
                  <div className="flex flex-col">
                    <span className="text-[9px] text-gray-500 font-bold uppercase">Отримаєте:</span>
                    <span className="text-3xl font-black text-white italic">{asCoins} <span className="text-red-500 text-xl">AS</span></span>
                  </div>
                  <div className="text-right"><span className="text-2xl">🪙</span></div>
              </div>
            </div>

            <button onClick={handlePay} disabled={!nickname || !amountUah || Number(amountUah) < 1} className="w-full evolve-button py-5 rounded-xl text-xs text-white tracking-widest disabled:opacity-30">
                Продовжити
            </button>
          </div>
        </section>

        <section className="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-6 animate-slide-up" style={{ animationDelay: '0.1s' }}>
            {PACKS.map((pack) => (
                <div key={pack.id} className="evolve-panel p-6 flex flex-col justify-between group cursor-pointer hover:border-red-600/30 transition-all" onClick={() => { setAmountUah(pack.price.toString()); playSound('click'); }}>
                    <div className="flex justify-between items-start mb-6">
                        <h3 className="text-lg font-black italic uppercase text-white tracking-tighter">Пак "{pack.name}"</h3>
                        <span className="text-3xl group-hover:scale-110 transition-transform">{pack.icon}</span>
                    </div>
                    <ul className="space-y-2 mb-8">
                        {pack.benefits.map((b, i) => (
                            <li key={i} className="text-[10px] font-medium text-gray-400 flex items-center gap-2">
                                <span className="w-1.5 h-1.5 bg-red-600 rounded-full"></span> {b}
                            </li>
                        ))}
                    </ul>
                    <div className="flex items-center justify-between pt-4 border-t border-white/5">
                        <span className="text-red-500 font-black text-xl italic">{pack.price} ₴</span>
                        <button className="bg-white/5 px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest text-gray-400 group-hover:bg-red-600 group-hover:text-white transition-all">Вибрати</button>
                    </div>
                </div>
            ))}
        </section>
      </main>

      {/* Payment Terminal Modal */}
      {showModal === DonationStep.PAYMENT && (
        <div className="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 backdrop-blur-xl p-0 md:p-4 overflow-y-auto">
          <div className="w-full max-w-5xl h-full md:h-auto md:min-h-[600px] flex flex-col lg:flex-row evolve-panel overflow-hidden shadow-2xl">
            
            <div className="flex-1 p-6 lg:p-10 flex flex-col bg-white/[0.02] min-w-0">
                <button onClick={() => setShowModal(null)} className="mb-8 text-gray-500 text-xs font-bold hover:text-white flex items-center gap-2">← Назад</button>
                
                <div className="flex-1 flex flex-col items-center justify-center w-full">
                    {paymentView === 'methods' ? (
                        <div className="w-full max-w-md space-y-8 animate-slide-up text-center">
                            <h3 className="text-3xl font-black italic uppercase text-white tracking-tighter">Шлюз оплати</h3>
                            <div className="grid grid-cols-1 gap-4">
                                <button onClick={() => { setPaymentView('ua_bank'); playSound('click'); }} className="p-8 evolve-panel bg-red-600/10 border-red-600/20 hover:bg-red-600 transition-all flex items-center gap-6 group">
                                    <span className="text-5xl">🇺🇦</span>
                                    <div className="text-left">
                                        <span className="block text-sm font-black text-white uppercase tracking-widest">Sense Bank</span>
                                        <span className="text-[10px] text-gray-400 uppercase">UA Card / Квитанція</span>
                                    </div>
                                </button>
                                <button onClick={() => { setPaymentView('paypal'); playSound('click'); }} className="p-8 evolve-panel bg-blue-600/10 border-blue-600/20 hover:bg-blue-600 transition-all flex items-center gap-6 group">
                                    <span className="text-5xl">🏦</span>
                                    <div className="text-left">
                                        <span className="block text-sm font-black text-white uppercase tracking-widest">PayPal</span>
                                        <span className="text-[10px] text-gray-400 uppercase">International / USD</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    ) : paymentView === 'paypal' ? (
                        <div className="w-full max-w-lg space-y-6 flex flex-col items-center animate-slide-up">
                            <div className="text-center w-full">
                                <h4 className="text-2xl font-black text-white italic uppercase mb-2 tracking-tighter">PayPal Dynamic</h4>
                                <p className="text-[11px] text-gray-500 uppercase font-bold tracking-widest mb-6 italic">Сайт автоматично передав суму: ${amountUsd} USD</p>
                            </div>
                            
                            <div className="w-full flex-1 flex flex-col items-center justify-center min-h-[300px] relative bg-black/20 rounded-[2rem] p-8 border border-white/5">
                                {isPaypalLoading && (
                                    <div className="flex flex-col items-center gap-4">
                                        <div className="animate-spin w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full"></div>
                                        <p className="text-[10px] text-blue-500 font-bold uppercase">Ініціалізація кнопок...</p>
                                    </div>
                                )}
                                {isPaypalVerified ? (
                                    <div className="text-center p-8 bg-green-500/10 border border-green-500/20 rounded-[2rem] w-full animate-slide-up">
                                        <span className="text-5xl block mb-4">✅</span>
                                        <h5 className="text-lg font-black text-green-500 uppercase italic">Транзакція успішна!</h5>
                                        <p className="text-[10px] text-gray-400 mt-2 uppercase">Натисніть кнопку "Я ОПЛАТИВ" праворуч для завершення.</p>
                                    </div>
                                ) : (
                                    <div id="paypal-button-container" className="w-full"></div>
                                )}
                            </div>
                        </div>
                    ) : (
                        <div className="w-full max-w-lg space-y-8 flex flex-col items-center animate-slide-up">
                            <h4 className="text-3xl font-black text-white italic uppercase tracking-tighter">Sense Bank (UA)</h4>
                            
                            <div className="bg-red-600/10 border border-red-600/20 p-6 rounded-2xl w-full text-center">
                                <p className="text-xs font-bold text-white uppercase italic mb-2">⚠️ Важлива інструкція</p>
                                <p className="text-[10px] text-gray-400 uppercase leading-relaxed">
                                    Вас буде перенаправлено на сторінку Sense Bank. <br/>
                                    Будь ласка, вкажіть там <b>ТОЧНУ СУМУ</b>, яку ви вказали на нашому сайті: 
                                    <span className="block text-xl text-red-500 font-black mt-2">{amountUah} UAH</span>
                                </p>
                            </div>

                            <div className="bg-white p-6 rounded-[2.5rem] shadow-2xl">
                                <img src={`https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(SENSE_BANK_LINK)}`} className="w-48 h-48" alt="QR" />
                            </div>

                            <div className="w-full space-y-4">
                                <a href={SENSE_BANK_LINK} target="_blank" className="block w-full text-center bg-red-600 py-4 rounded-2xl text-xs font-black uppercase tracking-widest text-white shadow-lg active:scale-95">Відкрити Sense Bank</a>
                                <div className="p-6 bg-white/5 rounded-2xl border border-white/10 space-y-4 text-left">
                                    <label className="block text-[10px] font-black uppercase tracking-widest text-gray-400">Додати квитанцію (фото):</label>
                                    <input type="file" accept="image/*" onChange={onFileChange} className="w-full text-[10px] text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-white/10 file:text-white" />
                                    {receiptFile && <p className="text-[10px] text-green-500 font-bold">✅ Квитанцію вибрано</p>}
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>

            <div className="w-full lg:w-[360px] bg-black/80 p-8 lg:p-12 flex flex-col border-l border-white/5 shrink-0">
                <div className="space-y-12 text-white flex-1">
                    <h5 className="text-[11px] font-black uppercase tracking-[0.3em] text-gray-600 italic border-b border-white/5 pb-6 leading-none">Деталі рахунку</h5>
                    <div className="space-y-8">
                        <div className="flex justify-between items-end"><span className="text-[10px] font-black text-gray-500 uppercase tracking-widest">Нік:</span><span className="text-lg font-black italic tracking-tighter leading-none">{nickname}</span></div>
                        <div className="flex justify-between items-end"><span className="text-[10px] font-black text-gray-500 uppercase tracking-widest">Нарахування:</span><span className="text-3xl text-red-500 font-black italic leading-none">+{asCoins} AS</span></div>
                        <div className="pt-10 border-t border-white/5 flex justify-between items-end"><span className="text-[10px] font-black text-gray-400 uppercase tracking-widest">До сплати:</span><span className="text-4xl font-black italic leading-none">{amountUah} ₴</span></div>
                    </div>
                </div>

                <div className="mt-12 space-y-5">
                    <div className={`p-8 rounded-[2rem] border text-center transition-all ${paymentStatus === 'not_paid' ? 'border-red-500/50 bg-red-500/10 animate-shake' : 'border-white/5 bg-black/40'}`}>
                        {paymentStatus === 'checking' ? (
                            <div className="flex flex-col items-center gap-3">
                                <div className="w-8 h-8 border-2 border-red-500 border-t-transparent rounded-full animate-spin"></div>
                                <span className="text-[10px] font-black uppercase text-red-500 tracking-[0.2em]">Перевірка...</span>
                            </div>
                        ) : paymentStatus === 'not_paid' ? (
                            <div className="space-y-2">
                                <span className="text-[10px] font-black uppercase text-red-500 block tracking-widest leading-tight">
                                    {paymentView === 'paypal' ? "Спершу оплатіть" : "Потрібна квитанція"}
                                </span>
                            </div>
                        ) : isPaypalVerified ? (
                            <span className="text-[10px] font-black uppercase text-green-500 tracking-[0.2em] block">Верифіковано!</span>
                        ) : (
                            <span className="text-[10px] font-black uppercase text-gray-600 tracking-[0.3em] italic">Очікуємо платіж</span>
                        )}
                    </div>
                    <button onClick={handleVerifyManual} disabled={paymentStatus === 'checking' || paymentStatus === 'success'} className="w-full py-6 rounded-2xl text-[12px] font-black uppercase tracking-[0.4em] bg-white text-black hover:bg-red-600 hover:text-white transition-all active:scale-95 shadow-xl">Я оплатив</button>
                </div>
            </div>
          </div>
        </div>
      )}

      {/* Success Modal */}
      {showModal === DonationStep.SUCCESS && (
        <div className="fixed inset-0 z-[110] flex items-center justify-center p-6 bg-black/99 backdrop-blur-3xl animate-in fade-in duration-500 text-center">
          <div className="w-full max-w-lg evolve-panel p-16 border-2 border-green-500/20 shadow-2xl">
            <div className="w-24 h-24 bg-green-500 rounded-3xl flex items-center justify-center mx-auto mb-10 text-5xl text-white shadow-[0_0_60px_rgba(34,197,94,0.5)] animate-bounce">✓</div>
            <h2 className="text-5xl font-black uppercase italic mb-6 text-white tracking-tighter leading-none">Дякуємо!</h2>
            <div className="bg-white/5 p-8 rounded-[2.5rem] border border-white/5 mb-8">
                <span className="text-green-500 font-black text-5xl italic tracking-tighter leading-none">+{asCoins} AS</span>
            </div>
            <p className="text-gray-400 text-sm mb-12 italic leading-relaxed px-6">
                {paymentView === 'paypal' 
                    ? `Валюта вже на вашому ігровому рахунку ${nickname}.` 
                    : `Чек отримано. Зарахування протягом 10-20 хвилин.`}
            </p>
            <button onClick={() => window.location.reload()} className="w-full evolve-button py-6 rounded-2xl text-[12px] text-white tracking-[0.4em] font-black uppercase shadow-lg">На головну</button>
          </div>
        </div>
      )}
    </div>
  );
};

export default App;
