import { login, useAppDispatch, useAppSelector } from '@/store'
import { useForm } from 'react-hook-form'
import { useNavigate } from 'react-router-dom'

interface Form {
  username: string
  password: string
}

export default function Auth() {
  const dispatch = useAppDispatch()
  const authStatus = useAppSelector((s) => s.auth.authStatus)
  const nav = useNavigate()
  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm<Form>()

  function onSubmit(data: Form) {
    dispatch(login(data))
      .unwrap()
      .then((res) => {
        if (res.code == 'ok') {
          nav('/')
        }
      })
  }

  return (
    <div className="flex-fill d-flex align-items-center justify-content-center h-100">
      <form
        className="card align-items-center p-4 shadow-lg"
        onSubmit={handleSubmit(onSubmit)}
      >
        <div className="form-outline mb-4">
          <label className="form-label">
            Ник или почта
            <input
              type="text"
              className="form-control"
              required
              {...register('username', { required: true })}
            />
          </label>
          {errors.username && (
            <div className="text-danger">Это поле обязательно</div>
          )}
        </div>

        <div className="form-outline mb-4">
          <label className="form-label">
            Пароль
            <input
              type="password"
              className="form-control"
              required
              {...register('password', { required: true })}
            />
          </label>
          {errors.password && (
            <div className="text-danger">Это поле обязательно</div>
          )}
        </div>

        <button className="btn btn-primary">
          {authStatus == 'process' ? (
            <div className="spinner-border" role="status" />
          ) : (
            'Войти'
          )}
        </button>
      </form>
    </div>
  )
}
