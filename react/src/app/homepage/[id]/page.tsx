'use client';

import { CustomDataGrid } from '@/app/components/CustomDataGrid';
import { useEffect, useState } from 'react';
import { orderStateButtons, Button as StateButton } from '@/lib/buttons';
import { Button, colors } from '@mui/material';
import { Payment } from '@/lib/payment';

export default function Payment({ params }: { params: { id: number } }) {
  const [payment, setPayment] = useState<Payment>();
  const [allowedActions, setAllowedActions] = useState([]);
  const [buttons, setButtons] = useState<StateButton[]>([]);

  async function fetchData() {
    // fetch
    const payment = await fetch(
      `http://127.0.0.1:8000/api/payment/${params.id}`,
      {
        headers: {
          Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
        },
      }
    );
    const allowedActions = await fetch(
      `http://127.0.0.1:8000/api/payment/${params.id}/allowedActions`,
      {
        headers: {
          Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
        },
      }
    );
    const allowedActionsJson = await allowedActions.json();
    const paymentJson = await payment.json();

    // state
    setPayment(paymentJson.data);
    setAllowedActions(allowedActionsJson.data);
    console.log('allowedActionsJson', allowedActionsJson);
    setButtons(
      orderStateButtons.filter((x) => allowedActionsJson?.includes(x.state))
    );
  }

  const updateState = async (path: string) => {
    console.log('process.env.AUTH', process.env.AUTH);
    const res = await fetch(
      `http://127.0.0.1:8000/api/payment/${params.id}${path}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
        } as HeadersInit,
      }
    );
    await fetchData();
  };

  useEffect(() => {
    fetchData();
  }, []);

  return (
    <>
      <div style={{ padding: '5%' }}>
        <CustomDataGrid params={payment}></CustomDataGrid>
      </div>
      <div>
        {buttons?.map((button, index) => (
          <Button
            key={index}
            sx={{ marginLeft: '80px', color: button.color }}
            onClick={() => updateState(button.link)}
          >
            {button?.text}
          </Button>
        ))}
      </div>
    </>
  );
}
