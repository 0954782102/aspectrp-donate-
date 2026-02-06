
export enum DonationStep {
  INTRO = 'INTRO',
  METHOD = 'METHOD',
  NICKNAME = 'NICKNAME',
  AMOUNT = 'AMOUNT',
  PAYMENT = 'PAYMENT',
  RECEIPT = 'RECEIPT',
  SUCCESS = 'SUCCESS'
}

export enum PaymentMethod {
  BANK = 'BANK',
  USDT = 'USDT'
}

export interface DonationData {
  method: PaymentMethod | null;
  nickname: string;
  amountUah: number;
  amountAsCoins: number;
  receipt: File | null;
}

export interface GeminiTip {
  title: string;
  content: string;
}
