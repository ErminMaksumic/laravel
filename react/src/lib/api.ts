export async function getPaymentById(id: number) {
  return await fetch(`${process.env.NEXT_PUBLIC_URL}/payment/${id}`, {
    headers: {
      Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
    },
  });
}

export async function getAllowedActions(id: number) {
  return await fetch(
    `${process.env.NEXT_PUBLIC_URL}/payment/${id}/allowedActions`,
    {
      headers: {
        Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
      },
    }
  );
}

export async function updatePayment(id: number, path: string) {
  return await fetch(`${process.env.NEXT_PUBLIC_URL}/payment/${id}${path}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
      Authorization: `Bearer ${process.env.NEXT_PUBLIC_AUTH}`,
    } as HeadersInit,
  });
}

export async function getPayments() {
  return await fetch(`${process.env.NEXT_PUBLIC_URL}/payment`);
}
