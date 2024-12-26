import axios from "axios";

const Api = axios.create({
  baseURL: "http://127.0.0.1:8000/api", // Ubah ini sesuai dengan URL API yang benar
  headers: {
    "Content-Type": "application/json",
    Accept: "application/json",
  },
});

// Log requests dan responses untuk debugging
Api.interceptors.request.use((request) => {
  console.log("Starting Request:", request);
  return request;
});

Api.interceptors.response.use(
  (response) => {
    console.log("Response:", response);
    return response;
  },
  (error) => {
    console.error("Response Error:", error.response);
    return Promise.reject(error);
  }
);

export default Api;
