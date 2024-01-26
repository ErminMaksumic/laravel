'use client';

import { CustomDataGrid } from '@/app/components/CustomDataGrid';
import { useEffect, useState } from 'react';
import { orderStateButtons, Button as StateButton } from '@/lib/buttons';
import { Button } from '@mui/material';
import { Payment } from '@/lib/payment';
import { getAllowedActions, getPaymentById, updatePayment } from '@/lib/api';
import { useDataContext } from '@/app/context/context';

export default function Payment({ params }: { params: { id: number } }) {
  const [payment, setPayment] = useState<Payment>();
  const [allowedActions, setAllowedActions] = useState([]);
  const [buttons, setButtons] = useState<StateButton[]>([]);
  const { getData } = useDataContext();


  async function fetchData() {
    // fetch data
    const payment = await getPaymentById(params.id);
    const allowedActions = await getAllowedActions(params.id);

    const allowedActionsJson = await allowedActions.json();
    const paymentJson = await payment.json();

    console.log('allowedActionsJson.data', allowedActionsJson.data);

    // state
    setPayment(paymentJson.data);
    setAllowedActions(allowedActionsJson.data);
    setButtons(
      orderStateButtons.filter((x) => allowedActionsJson?.includes(x.state))
    );
  }

  const updateState = async (path: string) => {
    await updatePayment(params.id, path);
    await fetchData();
    await getData();
    
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
            variant="outlined"
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
