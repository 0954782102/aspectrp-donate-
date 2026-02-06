
import React, { useState, useEffect, useRef } from 'react';
import { DonationStep } from './types';
import { PACKS, CONVERSION_RATE, playSound, SENSE_BANK_LINK } from './constants';

const UAH_TO_USD = 41.25; 

const App: React.FC = () => {
  const [nickname, setNickname] = useState('');
  const [amountUah, setAmountUah] = useState<string>('');
  const [selectedServer, setSelectedServer] = useState('Aspect RP #1');
  const [showModal, setShowModal] = useState<null | DonationStep>(null);
  const [paymentView, setPaymentView] = useState<'methods' | 'paypal' | 'ua_bank'>('methods');
  const [paymentStatus, setPaymentStatus] = useState<'pending' | 'checking' | 'success' | 'not_paid' | 'error'>('pending');
  const [isPaypalLoading, setIsPaypalLoading] = useState(false);
  const [paypalError, setPaypalError] = useState(false);
  const [isPaypalVerified, setIsPaypalVerified] = useState(false);
  const [receiptFile, setReceiptFile] = useState<File | null>(null);
  
  const isRendering = useRef(false);
  const containerId = "paypal-container-RE425JCZ8AWXY";

  const asCoins = amountUah ? Math.floor(Number(amountUah) * CONVERSION_RATE) : 0;
  const amountUsd = amountUah ? (Number(amountUah) / UAH_TO_USD).toFixed(2) : "0.00";

  const handlePay = () => {
    if (!nickname || !amountUah || Number(amountUah) <= 0) return;
    playSound('click');
    setPaymentStatus('pending');
    setPaymentView('methods');
    setIsPaypalVerified(false);
    setReceiptFile(null);
    setShowModal(DonationStep.PAYMENT);
  };

  const startPayPalFlow = () => {
    playSound('click');
    setPaymentView('paypal');
    setIsPaypalLoading(true);
    setPaypalError(false);
    isRendering.current = false;
  };

  const startUABankFlow = () => {
    playSound('click');
    setPaymentView('ua_bank');
    setReceiptFile(null);
  };

  // PayPal Logic with actual verification
  useEffect(() => {
    let pollTimer: any;
    
    const tryRender = () => {
        if (isRendering.current) return;
        const paypal = (window as any).paypal;
        const element = document.getElementById(containerId);

        if (paypal && paypal.HostedButtons && element) {
            isRendering.current = true;
            try {
                element.innerHTML = "";
                paypal.HostedButtons({
                    hostedButtonId: "RE425JCZ8AWXY",
                    // Додаємо обробку завершення оплати
                    onApprove: (data: any, actions: any) => {
                        console.log("PayPal Approved:", data);
                        setIsPaypalVerified(true);
                        playSound('success');
                        return Promise.resolve();
                    },
                    onError: (err: any) => {
                        console.error("PayPal SDK Error:", err);
                        setPaypalError(true);
                    }
                }).render(`#${containerId}`)
                .then(() => {
                    setIsPaypalLoading(false);
                    setPaypalError(false);
                })
                .catch((err: any) => {
                    console.error("Render Catch:", err);
                    setPaypalError(true);
                    setIsPaypalLoading(false);
                    isRendering.current = false;
                });
            } catch (e) {
                setPaypalError(true);
                setIsPaypalLoading(false);
                isRendering.current = false;
            }
        } else if (paymentView === 'paypal') {
            pollTimer = setTimeout(tryRender, 500);
        }
    };

    if (showModal === DonationStep.PAYMENT && paymentView === 'paypal') {
        setTimeout(tryRender, 600);
    }

    return () => clearTimeout(pollTimer);
  }, [showModal, paymentView]);

  const handleVerifyManual = () => {
    // Валідація: якщо PayPal — має бути підтвердження від SDK
    if (paymentView === 'paypal' && !isPaypalVerified) {
        setPaymentStatus('not_paid');
        setTimeout(() => setPaymentStatus('pending'), 3000);
        return;
    }

    // Валідація: якщо Банк — має бути завантажений файл
    if (paymentView === 'ua_bank' && !receiptFile) {
        setPaymentStatus('not_paid');
        setTimeout(() => setPaymentStatus('pending'), 3000);
        return;
    }

    setPaymentStatus('checking');
    playSound('click');
    
    // Симуляція глибокої перевірки (транзакції/чека)
    setTimeout(() => {
      setPaymentStatus('success');
      playSound('success');
      setTimeout(() => setShowModal(DonationStep.SUCCESS), 1500);
    }, 4000);
  };

  const onFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    if (e.target.files && e.target.files[0]) {
        setReceiptFile(e.target.files[0]);
        playSound('click');
    }
  };

  return (
    <div className="flex flex-col min-h-full">
      {/* Header */}
      <nav className="w-full h-24 px-6 lg:px-24 flex items-center justify-between z-50">
        <div className="flex items-center gap-4">
          <div className="w-14 h-14 bg-red-600 rounded-2xl flex items-center justify-center font-black text-3xl italic shadow-[0_0_30px_rgba(220,38,38,0.4)]">A</div>
          <div className="flex flex-col leading-tight text-white">
            <span className="font-black text-2xl tracking-tighter">ASPECT</span>
            <span className="text-[10px] text-red-500 font-bold tracking-[0.4em] uppercase">Role Play</span>
          </div>
        </div>
        <div className="hidden md:flex items-center gap-4">
            <div className="bg-white/5 px-6 py-2 rounded-full border border-white/5 backdrop-blur-xl flex items-center gap-3">
                <div className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span className="text-[10px] font-black uppercase text-gray-400">Server Online</span>
            </div>
        </div>
      </nav>

      {/* Main Content */}
      <main className="flex-1 w-full max-w-[1600px] mx-auto px-6 lg:px-24 py-6 flex flex-col lg:flex-row items-start justify-center gap-12">
        <section className="w-full lg:w-[480px] animate-slide-up">
          <div className="evolve-panel p-10 space-y-8 shadow-[0_20px_60px_rgba(0,0,0,0.4)] relative border-t-4 border-red-600">
            <div className="absolute top-0 right-0 px-5 py-2 bg-red-600 text-[10px] font-black uppercase italic rounded-bl-2xl text-white">Aspect Pay</div>
            <div className="space-y-1">
                <h2 className="text-3xl font-black uppercase tracking-tighter italic leading-none text-white">Донат-рахунок</h2>
                <p className="text-gray-500 text-[10px] font-bold uppercase tracking-widest">Купівля ігрової валюти</p>
            </div>
            <div className="space-y-5">
              <select className="w-full evolve-input p-5 rounded-2xl text-sm appearance-none outline-none cursor-pointer" value={selectedServer} onChange={(e) => setSelectedServer(e.target.value)}>
                <option value="Aspect RP #1">Aspect Role Play #1</option>
                <option value="Aspect RP #2">Aspect Role Play #2</option>
              </select>
              <div className="relative group">
                <input type="text" placeholder="Ігровий нікнейм" className="w-full evolve-input p-5 rounded-2xl text-sm outline-none" value={nickname} onChange={(e) => setNickname(e.target.value)} />
                <span className="absolute right-6 top-1/2 -translate-y-1/2 text-gray-600 group-focus-within:text-red-500 transition-colors">👤</span>
              </div>
              <div className="relative group">
                <input type="number" placeholder="Сума (UAH)" className="w-full evolve-input p-5 rounded-2xl text-sm outline-none pr-28" value={amountUah} onChange={(e) => setAmountUah(e.target.value)} />
                <span className="absolute right-6 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-500 uppercase border-l border-white/10 pl-5">UAH</span>
              </div>
              <div className="bg-red-600/5 rounded-3xl p-7 border border-red-600/20 flex items-center justify-between">
                  <div className="space-y-1">
                    <p className="text-[10px] text-gray-500 font-black uppercase tracking-widest">Ви отримаєте:</p>
                    <p className="text-4xl font-black text-white italic tracking-tighter">{asCoins} <span className="text-red-500 text-2xl">AS</span></p>
                  </div>
                  <div className="text-right flex flex-col items-end">
                    <p className="text-[10px] text-gray-500 font-black uppercase tracking-widest">Курс:</p>
                    <p className="text-xl font-black text-gray-400 italic">1:{CONVERSION_RATE}</p>
                  </div>
              </div>
            </div>
            <button onClick={handlePay} disabled={!nickname || !amountUah || Number(amountUah) <= 0} className="w-full evolve-button py-6 rounded-2xl text-sm disabled:opacity-20 transition-all font-black uppercase tracking-widest text-white">Почати оплату</button>
          </div>
        </section>

        <section className="flex-1 space-y-10 animate-slide-up" style={{ animationDelay: '0.1s' }}>
          <h2 className="text-4xl font-black uppercase tracking-tighter italic glowing-text leading-none text-white">Вигідні пакети</h2>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            {PACKS.map((pack) => (
              <div key={pack.id} className="evolve-panel p-8 pack-card flex flex-col justify-between relative group cursor-pointer" onClick={() => { setAmountUah(pack.price.toString()); playSound('click'); }}>
                <div className="absolute top-6 right-8 text-5xl opacity-5 group-hover:opacity-100 transition-all duration-500">{pack.icon}</div>
                <div>
                  <h3 className="text-2xl font-black italic uppercase mb-8 tracking-tighter border-b border-white/10 pb-3 inline-block text-white">Пак "{pack.name}"</h3>
                  <ul className="space-y-4 mb-12">
                    {pack.benefits.map((benefit, i) => (
                      <li key={i} className="flex items-center gap-4 text-[11px] font-bold text-gray-400">
                        <span className="w-5 h-[2px] bg-red-600 shadow-[0_0_10px_rgba(255,75,43,0.5)]"></span>{benefit}
                      </li>
                    ))}
                  </ul>
                </div>
                <div className="flex items-center justify-between gap-6">
                  <button className="evolve-button flex-1 py-5 rounded-2xl text-[11px] font-black uppercase tracking-widest text-white">Вибрати</button>
                  <div className="bg-white/5 px-6 py-4 rounded-2xl text-sm font-black text-red-500 border border-white/10">{pack.price} UAH</div>
                </div>
              </div>
            ))}
          </div>
        </section>
      </main>

      {/* Payment Terminal Modal */}
      {showModal === DonationStep.PAYMENT && (
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-0 lg:p-10 bg-black/98 backdrop-blur-3xl animate-in fade-in duration-500">
          <div className="w-full max-w-6xl h-full lg:h-[90vh] flex flex-col lg:rounded-[3rem] overflow-hidden bg-[#0c0c10] border border-white/10 shadow-2xl relative">
            <div className="bg-[#15151b] p-8 border-b border-white/10 flex items-center justify-between shrink-0">
                <div className="flex items-center gap-8 text-white">
                    <button onClick={() => setShowModal(null)} className="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center hover:bg-white/10 transition-all text-xl">✕</button>
                    <div className="flex flex-col">
                        <h3 className="text-white font-black italic uppercase text-2xl tracking-tighter leading-none">Платіжний термінал</h3>
                        <p className="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">Гравець: {nickname.toUpperCase()}</p>
                    </div>
                </div>
                <div className="hidden sm:flex items-center gap-5 bg-black/50 px-8 py-3 rounded-full border border-green-500/20">
                    <div className="w-2.5 h-2.5 bg-green-500 rounded-full animate-pulse"></div>
                    <span className="text-[11px] font-black uppercase text-green-500 tracking-[0.2em]">Верифікована сесія</span>
                </div>
            </div>

            <div className="flex-1 flex flex-col lg:flex-row overflow-hidden bg-white">
                <div className="flex-1 relative flex flex-col overflow-y-auto bg-[#fcfcfe]">
                    {paymentView === 'methods' ? (
                        <div className="h-full flex flex-col items-center justify-center p-10 lg:p-16 text-center">
                            <h3 className="text-black font-black uppercase italic text-4xl mb-12 tracking-tighter leading-none">Оберіть шлюз оплати</h3>
                            <div className="grid grid-cols-1 gap-8 w-full max-w-sm">
                                <button onClick={startUABankFlow} className="w-full bg-[#ff4b2b] text-white p-10 rounded-[2.5rem] flex items-center justify-between shadow-xl hover:scale-[1.03] transition-all group">
                                    <div className="flex flex-col items-start">
                                        <span className="text-[11px] font-black uppercase tracking-widest opacity-80 mb-1">Карти України / QR</span>
                                        <span className="text-3xl font-black italic">Sense Bank</span>
                                    </div>
                                    <span className="text-5xl group-hover:rotate-12 transition-transform">🇺🇦</span>
                                </button>
                                <button onClick={startPayPalFlow} className="w-full bg-[#0070ba] text-white p-10 rounded-[2.5rem] flex items-center justify-between shadow-xl hover:scale-[1.03] transition-all group">
                                    <div className="flex flex-col items-start">
                                        <span className="text-[11px] font-black uppercase tracking-widest opacity-80 mb-1">International</span>
                                        <span className="text-3xl font-black italic">PayPal</span>
                                    </div>
                                    <span className="text-5xl group-hover:rotate-12 transition-transform">🏦</span>
                                </button>
                            </div>
                        </div>
                    ) : paymentView === 'paypal' ? (
                        <div className="h-full flex flex-col animate-in fade-in duration-500 p-8 lg:p-12 overflow-y-auto">
                            <div className="w-full max-w-lg mx-auto space-y-8 flex flex-col">
                                <div className="text-center shrink-0">
                                    <h3 className="text-3xl font-black text-black uppercase italic tracking-tighter mb-2 leading-none">PayPal Checkout</h3>
                                    <p className="text-gray-500 text-[10px] font-bold uppercase tracking-[0.2em]">Потрібно підтвердження від платіжної системи</p>
                                </div>
                                <div className="bg-white p-8 rounded-[3rem] shadow-2xl border border-gray-100 space-y-6">
                                    <div className="flex justify-between items-center text-black">
                                        <span className="text-xs font-black text-gray-400 uppercase tracking-widest">До сплати:</span>
                                        <span className="text-3xl font-black tracking-tighter italic text-blue-600">${amountUsd} USD</span>
                                    </div>
                                    
                                    <div className={`p-5 rounded-2xl border transition-all ${isPaypalVerified ? 'bg-green-50 border-green-200' : 'bg-blue-50 border-blue-200'}`}>
                                        {isPaypalVerified ? (
                                            <div className="flex items-center gap-4 text-green-700">
                                                <div className="text-2xl">✅</div>
                                                <p className="text-[11px] font-black uppercase tracking-widest">Оплата підтверджена! Натисніть "Я оплатив" справа.</p>
                                            </div>
                                        ) : (
                                            <p className="text-[10px] text-blue-700 space-y-2 font-medium leading-relaxed italic text-center">
                                                Виконайте оплату у вікні PayPal нижче. Коли статус зміниться на успішний, кнопка підтвердження стане активною.
                                            </p>
                                        )}
                                    </div>

                                    <div className="relative min-h-[200px] w-full flex flex-col items-center justify-center">
                                        {isPaypalLoading && !paypalError && (
                                            <div className="absolute inset-0 flex flex-col items-center justify-center bg-white z-10 gap-4">
                                                <div className="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                                                <p className="text-[10px] font-black uppercase text-blue-600 tracking-widest">З'єднання...</p>
                                            </div>
                                        )}
                                        
                                        {paypalError ? (
                                          <div className="p-10 text-center space-y-5 animate-in zoom-in duration-300">
                                            <p className="text-red-500 text-[11px] font-black uppercase tracking-widest">Помилка шлюзу</p>
                                            <button onClick={startPayPalFlow} className="bg-blue-600 text-white px-8 py-3 rounded-full text-[10px] font-black uppercase">Повторити</button>
                                          </div>
                                        ) : (
                                          <div id={containerId} className="w-full"></div>
                                        )}
                                    </div>
                                </div>
                                <div className="text-center pb-8">
                                    <button onClick={() => setPaymentView('methods')} className="text-[11px] font-black uppercase text-gray-400 hover:text-blue-600 tracking-[0.2em]">← Назад</button>
                                </div>
                            </div>
                        </div>
                    ) : (
                        <div className="h-full flex flex-col animate-in fade-in duration-500 p-8 lg:p-16 items-center overflow-y-auto">
                            <div className="w-full max-w-lg mx-auto text-center space-y-10">
                                <h3 className="text-black font-black uppercase italic text-4xl tracking-tighter leading-none">Оплата Sense Bank</h3>
                                <div className="bg-white p-6 rounded-[3rem] shadow-2xl border border-gray-100 inline-block mx-auto transform hover:scale-105 transition-all">
                                    <img src={`https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(SENSE_BANK_LINK)}`} alt="QR" className="w-56 h-56" />
                                </div>
                                
                                <div className="bg-gray-50 p-8 rounded-[2rem] border border-gray-200 text-left space-y-6">
                                    <div className="flex items-start gap-4">
                                        <div className="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-black shrink-0">1</div>
                                        <p className="text-[12px] text-gray-700 font-bold leading-relaxed">Оплатіть за QR-кодом вище або перейдіть за <a href={SENSE_BANK_LINK} target="_blank" className="text-red-600 underline">посиланням</a>.</p>
                                    </div>
                                    <div className="flex items-start gap-4">
                                        <div className="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-black shrink-0">2</div>
                                        <div className="flex-1">
                                            <p className="text-[12px] text-gray-700 font-bold leading-relaxed mb-4">Зробіть скріншот квитанції та завантажте його сюди для перевірки:</p>
                                            <label className="block w-full border-2 border-dashed border-red-200 hover:border-red-500 bg-white p-6 rounded-2xl cursor-pointer transition-all text-center">
                                                <input type="file" accept="image/*" className="hidden" onChange={onFileChange} />
                                                <span className="text-[10px] font-black uppercase tracking-widest text-red-600">
                                                    {receiptFile ? `📁 ${receiptFile.name}` : "📁 Вибрати скріншот"}
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button onClick={() => setPaymentView('methods')} className="text-[12px] font-black uppercase text-gray-400 tracking-[0.3em] underline decoration-red-500 underline-offset-8">Змінити метод</button>
                            </div>
                        </div>
                    )}
                </div>

                <div className="w-full lg:w-[450px] bg-[#121217] p-12 border-l border-white/10 flex flex-col shadow-2xl z-10 shrink-0">
                    <div className="space-y-16 text-white">
                        <h4 className="text-[11px] font-black uppercase tracking-[0.4em] text-gray-600 border-b border-white/10 pb-6 italic">Рахунок замовлення</h4>
                        <div className="space-y-10">
                            <div className="flex justify-between items-end"><span className="text-[11px] font-black text-gray-500 uppercase tracking-widest">Нікнейм:</span><span className="text-xl font-black italic tracking-tighter">{nickname}</span></div>
                            <div className="flex justify-between items-end"><span className="text-[11px] font-black text-gray-500 uppercase tracking-widest">Отримаєте:</span><span className="text-3xl text-red-500 font-black italic leading-none">+{asCoins} AS</span></div>
                            <div className="pt-10 border-t border-white/10 flex justify-between items-end"><span className="text-[11px] font-black text-gray-400 uppercase">До сплати:</span><span className="text-4xl font-black italic">{amountUah} ₴</span></div>
                        </div>
                    </div>
                    <div className="mt-auto pt-16 space-y-8">
                        <div className={`bg-black/40 p-10 rounded-[3rem] border text-center shadow-inner relative overflow-hidden transition-all ${paymentStatus === 'not_paid' ? 'border-red-500/50 bg-red-500/5' : 'border-white/5'}`}>
                            {paymentStatus === 'checking' ? (
                                <div className="space-y-6 animate-pulse">
                                    <div className="w-14 h-14 border-4 border-red-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
                                    <p className="text-[11px] font-black uppercase text-red-500 italic tracking-[0.3em]">Валідація платежу...</p>
                                </div>
                            ) : paymentStatus === 'success' ? (
                                <div className="space-y-5 animate-in zoom-in duration-300">
                                    <div className="text-6xl text-green-500">✓</div>
                                    <p className="text-[11px] font-black uppercase text-green-500 tracking-[0.3em]">Успішно</p>
                                </div>
                            ) : paymentStatus === 'not_paid' ? (
                                <div className="space-y-5 animate-in shake duration-300">
                                    <div className="text-6xl text-red-500">❌</div>
                                    <p className="text-[11px] font-black uppercase text-red-500 tracking-[0.2em] leading-relaxed">
                                        {paymentView === 'paypal' ? "Оплата не виявлена" : "Завантажте чек"}
                                    </p>
                                </div>
                            ) : (
                                <div className="flex flex-col gap-6">
                                    <div className="flex justify-center gap-3">
                                        <div className="w-2 h-2 bg-gray-800 rounded-full animate-bounce"></div>
                                        <div className="w-2 h-2 bg-gray-800 rounded-full animate-bounce [animation-delay:-0.15s]"></div>
                                        <div className="w-2 h-2 bg-gray-800 rounded-full animate-bounce [animation-delay:-0.3s]"></div>
                                    </div>
                                    <p className="text-[11px] font-black uppercase text-gray-600 tracking-[0.4em]">Очікування валідації</p>
                                </div>
                            )}
                        </div>
                        <button 
                            onClick={handleVerifyManual} 
                            disabled={paymentStatus === 'checking' || paymentStatus === 'success'} 
                            className={`w-full py-7 rounded-[2rem] text-[12px] font-black uppercase tracking-[0.4em] transition-all shadow-2xl 
                                ${paymentStatus === 'checking' ? 'bg-gray-800 text-gray-600' : 'bg-red-600 text-white hover:brightness-110 active:scale-95'}`}
                        >
                            Я оплатив
                        </button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      )}

      {/* Success Modal */}
      {showModal === DonationStep.SUCCESS && (
        <div className="fixed inset-0 z-[110] flex items-center justify-center p-6 bg-black/99 backdrop-blur-3xl animate-in fade-in duration-700 text-white">
          <div className="w-full max-w-2xl evolve-panel p-20 text-center border-2 border-green-500/20 shadow-2xl">
            <div className="w-32 h-32 bg-green-500 rounded-[2.5rem] flex items-center justify-center mx-auto mb-12 text-6xl shadow-[0_0_80px_rgba(34,197,94,0.6)] animate-bounce text-white">✓</div>
            <h2 className="text-6xl font-black uppercase italic mb-10 tracking-tighter glowing-text text-white leading-none">Дякуємо!</h2>
            <div className="bg-white/5 p-12 rounded-[3.5rem] border border-white/5 mb-12 shadow-inner">
                <p className="text-gray-500 text-[11px] uppercase tracking-[0.5em] mb-6 font-black">Кошти зараховано</p>
                <span className="text-green-500 font-black text-6xl italic tracking-tighter leading-none">+{asCoins} AS</span>
            </div>
            <p className="text-gray-400 text-base mb-16 italic font-medium px-8 opacity-90 text-white leading-relaxed">
                {paymentView === 'paypal' 
                    ? `Валюта AS Coins вже нарахована на ваш аккаунт ${nickname}!` 
                    : `Дякуємо, ${nickname}! Ваш чек відправлений на перевірку модераторам. Очікуйте AS Coins протягом 10-20 хвилин.`}
            </p>
            <button onClick={() => window.location.reload()} className="w-full evolve-button py-7 rounded-[2rem] text-[12px] tracking-[0.5em] font-black uppercase">Повернутись на головну</button>
          </div>
        </div>
      )}
      
      <div className="fixed top-[10%] left-[-15%] w-[700px] h-[700px] bg-red-600/10 rounded-full blur-[250px] pointer-events-none animate-pulse"></div>
      <div className="fixed bottom-[-20%] right-[-15%] w-[800px] h-[800px] bg-red-600/10 rounded-full blur-[300px] pointer-events-none"></div>
    </div>
  );
};

export default App;
