import React, { useEffect, useState } from "react";
import axios from "axios";

const Chat = () => {
  const [messages, setMessages] = useState<
    { author: string; content: string }[]
  >([]);
  const [message, setMessage] = useState("");

  useEffect(() => {
    const url = new URL("http://localhost:3000/chat");
    url.searchParams.append("topic", "http://localhost:3000/chat");

    const eventSource = new EventSource(url.toString());

    eventSource.onmessage = (event) => {
      const data = JSON.parse(event.data);
      setMessages((prevMessages) => [...prevMessages, data]);
    };

    eventSource.onerror = (error) => {
      console.error("EventSource failed:", error);
      eventSource.close();
    };

    return () => {
      eventSource.close();
    };
  }, []);

  const sendMessage = async () => {
    try {
      await axios.post(
        "http://localhost:8000/chat/send",
        {
          content: message,
        },
        {
          headers: {
            "Content-Type": "application/json",
            // Include authentication token if required
          },
        }
      );
      setMessage(""); // Clear the input field after sending
    } catch (error) {
      console.error("Error sending message:", error);
    }
  };

  return (
    <div>
      <div>
        {messages.map((msg, index) => (
          <div key={index}>
            <strong>{msg.author}:</strong> {msg.content}
          </div>
        ))}
      </div>
      <input
        type="text"
        value={message}
        onChange={(e) => setMessage(e.target.value)}
        placeholder="Type your message..."
      />
      <button onClick={sendMessage}>Send</button>
    </div>
  );
};

export default Chat;
