export interface Button {
  text: string;
  link: string;
  state: string;
  color: string;
}

export const orderStateButtons: Button[] = [
  {
    text: 'Process',
    link: '/paymentProcess',
    state: 'PROCESSING',
    color: 'blue',
  },
  {
    text: 'Approve',
    link: '/paymentApprove',
    state: 'APPROVED',
    color: 'green',
  },
  {
    text: 'Reject',
    link: '/paymentReject',
    state: 'REJECTED',
    color: 'red',
  },
];
