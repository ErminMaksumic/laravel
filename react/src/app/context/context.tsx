'use client';

import {
  Dispatch,
  ReactNode,
  SetStateAction,
  createContext,
  useContext,
  useEffect,
  useState,
} from 'react';

interface DataContextProps {
  data?: any;
  setData?: Dispatch<SetStateAction<never[]>> | null;
}

interface DataProviderProps {
  children: ReactNode;
}

export const DataContext = createContext<any>({});

export const DataProvider: React.FC<DataProviderProps> = (props) => {
  const [data, setData] = useState({ result: [] });

  useEffect(() => {
    getData();
  }, []);

  const getData = async () => {
    console.log('fetching');
    const res = await fetch('http://127.0.0.1:8000/api/payment');
    const resJson = await res.json();
    setData(resJson.result);
  };

  const values = {
    data,
    setData,
  };

  return (
    <DataContext.Provider value={values}>{props.children}</DataContext.Provider>
  );
};

export const useDataContext = () => {
  return useContext(DataContext);
};
