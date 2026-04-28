import emailjs from "@emailjs/browser";

const SERVICE_ID = import.meta.env.VITE_EMAILJS_SERVICE_ID;
const TEMPLATE_ID = import.meta.env.VITE_EMAILJS_TEMPLATE_ID;
const PUBLIC_KEY = import.meta.env.VITE_EMAILJS_PUBLIC_KEY;
const TO_EMAIL = import.meta.env.VITE_CONTACT_TO_EMAIL || "elfaquihi.ayoub@gmail.com";

const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export function validateContactPayload(payload) {
  const errors = {};
  if (!payload.name?.trim()) errors.name = "Full name is required.";
  if (!payload.email?.trim()) {
    errors.email = "Email is required.";
  } else if (!EMAIL_REGEX.test(payload.email.trim())) {
    errors.email = "Please provide a valid email address.";
  }
  if (!payload.subject?.trim()) errors.subject = "Subject is required.";
  if (!payload.message?.trim()) {
    errors.message = "Message is required.";
  } else if (payload.message.trim().length < 10) {
    errors.message = "Message should be at least 10 characters.";
  }
  return { isValid: Object.keys(errors).length === 0, errors };
}

export async function submitContactForm(payload) {
  if (payload.honeypot) {
    return { ok: true, message: "Message sent successfully." };
  }

  const { isValid, errors } = validateContactPayload(payload);
  if (!isValid) {
    const firstError = Object.values(errors)[0];
    const error = new Error(firstError);
    error.fieldErrors = errors;
    throw error;
  }

  if (!SERVICE_ID || !TEMPLATE_ID || !PUBLIC_KEY) {
    throw new Error(
      "Email service is not configured yet. Add VITE_EMAILJS_* variables in .env to enable real delivery."
    );
  }

  const templateParams = {
    from_name: payload.name.trim(),
    from_email: payload.email.trim(),
    subject: payload.subject.trim(),
    message: payload.message.trim(),
    to_email: TO_EMAIL,
    reply_to: payload.email.trim(),
  };

  try {
    await emailjs.send(SERVICE_ID, TEMPLATE_ID, templateParams, {
      publicKey: PUBLIC_KEY,
    });
    return { ok: true, message: "Message sent successfully." };
  } catch (error) {
    const message =
      error?.text || error?.message || "Unable to send your message. Please try again.";
    throw new Error(message);
  }
}
