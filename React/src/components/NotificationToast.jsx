import React, { useState, useEffect, useRef } from 'react';
import "../NotificationToast.css"

const NotificationToast = ({ title, message, type, duration = 5000 }) => {
  const toastRef = useRef(null);

  const [isActive, setIsActive] = useState(true);
  const [isProgressActive, setIsProgressActive] = useState(true);

  useEffect(() => {
    const timeout1 = setTimeout(() => {
      setIsActive(false);
    }, duration);

    const timeout2 = setTimeout(() => {
      setIsProgressActive(false);
    }, duration + 300);

    return () => {
      clearTimeout(timeout1);
      clearTimeout(timeout2);
    };
  }, [duration]);

  const handleClose = () => {
    setIsActive(false);

    setTimeout(() => {
      setIsProgressActive(false);
    }, 300);
  };

  let iconClass;

  switch (type) {
    case 'success':
      iconClass = 'las la-check check success';
      break;
    case 'error':
      iconClass = 'las la-times check error';
      break;
    default:
      iconClass = '';
  }

  return (
    <div id="notification-container">
      <div ref={toastRef} className={`notification-toast ${isActive ? 'active' : ''}`}>
        <div className="toast-content">
            <i className={`fas fa-solid ${iconClass}`} />
            <div className="message">
              <span className="text text-1">{title}</span>
              <span className="text text-2">{message}</span>
            </div>
        </div>
        <i className="fa-solid las la-times close" onClick={handleClose} />
        <div className={`progress ${type} ${isProgressActive ? 'active' : ''}`} />
      </div>
    </div>
  );
};

export default NotificationToast;
