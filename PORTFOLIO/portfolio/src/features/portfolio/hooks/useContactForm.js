import { useCallback, useState } from "react";
import toast from "react-hot-toast";
import { submitContactForm, validateContactPayload } from "../api/contactApi";

const initialValues = {
  name: "",
  email: "",
  subject: "",
  message: "",
  honeypot: "",
};

export function useContactForm() {
  const [values, setValues] = useState(initialValues);
  const [errors, setErrors] = useState({});
  const [status, setStatus] = useState({ type: "", message: "" });
  const [isSubmitting, setIsSubmitting] = useState(false);

  const updateField = useCallback((key, value) => {
    setValues((prev) => ({ ...prev, [key]: value }));
    setErrors((prev) => {
      if (!prev[key]) return prev;
      const next = { ...prev };
      delete next[key];
      return next;
    });
  }, []);

  const reset = useCallback(() => {
    setValues(initialValues);
    setErrors({});
    setStatus({ type: "", message: "" });
  }, []);

  const handleSubmit = useCallback(
    async (event) => {
      event.preventDefault();
      if (isSubmitting) return;

      const validation = validateContactPayload(values);
      if (!validation.isValid) {
        setErrors(validation.errors);
        const firstError = Object.values(validation.errors)[0];
        toast.error(firstError);
        return;
      }

      setIsSubmitting(true);
      setStatus({ type: "", message: "" });
      const toastId = toast.loading("Sending your message...");

      try {
        const result = await submitContactForm(values);
        toast.success(result.message, { id: toastId });
        setStatus({ type: "success", message: result.message });
        setValues(initialValues);
        setErrors({});
      } catch (error) {
        const message = error.message || "Unable to send message.";
        toast.error(message, { id: toastId });
        setStatus({ type: "error", message });
        if (error.fieldErrors) setErrors(error.fieldErrors);
      } finally {
        setIsSubmitting(false);
      }
    },
    [isSubmitting, values]
  );

  return {
    values,
    errors,
    status,
    isSubmitting,
    updateField,
    handleSubmit,
    reset,
  };
}
