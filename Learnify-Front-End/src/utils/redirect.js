const REDIRECT_KEY = "intended_destination";
const REDIRECT_COURSE_KEY = "intended_course_id";

/**
 * Save the intended destination before redirecting to login
 */
export const saveIntendedDestination = (path, courseId = null) => {
  try {
    sessionStorage.setItem(REDIRECT_KEY, path);
    if (courseId) {
      sessionStorage.setItem(REDIRECT_COURSE_KEY, courseId);
    }
  } catch (e) {
    console.warn("Failed to save redirect destination", e);
  }
};

/**
 * Get and clear the intended destination
 */
export const getIntendedDestination = () => {
  try {
    const path = sessionStorage.getItem(REDIRECT_KEY);
    const courseId = sessionStorage.getItem(REDIRECT_COURSE_KEY);

    // Clear after reading
    sessionStorage.removeItem(REDIRECT_KEY);
    sessionStorage.removeItem(REDIRECT_COURSE_KEY);

    return { path, courseId };
  } catch (e) {
    return { path: null, courseId: null };
  }
};

/**
 * Clear saved redirect info
 */
export const clearIntendedDestination = () => {
  try {
    sessionStorage.removeItem(REDIRECT_KEY);
    sessionStorage.removeItem(REDIRECT_COURSE_KEY);
  } catch (e) {
    // ignore
  }
};
