
import { GoogleGenAI, Type } from "@google/genai";
import { GeminiTip } from "../types";

export const getGameTip = async (): Promise<GeminiTip> => {
  const ai = new GoogleGenAI({ apiKey: process.env.API_KEY });
  try {
    const response = await ai.models.generateContent({
      model: "gemini-3-flash-preview",
      contents: "Згенеруй випадкову коротку пораду для гравця SAMP (San Andreas Multiplayer) Role Play проекту. Вона має бути цікавою та мотивуючою. Формат: Назва та Текст.",
      config: {
        responseMimeType: "application/json",
        responseSchema: {
          type: Type.OBJECT,
          properties: {
            title: { type: Type.STRING },
            content: { type: Type.STRING }
          },
          required: ["title", "content"]
        }
      }
    });
    return JSON.parse(response.text) as GeminiTip;
  } catch (error) {
    console.error("Gemini error:", error);
    return {
      title: "Порада від Адміністрації",
      content: "Пам'ятайте, що Role Play - це насамперед про взаємодію. Будьте ввічливими з іншими гравцями!"
    };
  }
};
