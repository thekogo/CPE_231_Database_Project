<template>
  <jet-authentication-card register="true">
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <jet-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div class="grid grid-cols-2 gap-5">
        <div>
          <jet-label for="firstName" value="First Name" />
          <jet-input
            id="firstName"
            type="text"
            class="mt-1 block w-full"
            v-model="form.firstName"
            required
            autofocus
            autocomplete="firstName"
          />
        </div>

        <div>
          <jet-label for="lastName" value="Last Name" />
          <jet-input
            id="lastName"
            type="text"
            class="mt-1 block w-full"
            v-model="form.lastName"
            required
            autofocus
            autocomplete="lastName"
          />
        </div>
      </div>

      <div>
        <jet-label for="address" value="Address" />
        <jet-text-area
          id="address"
          type="text"
          class="mt-1 block w-full"
          v-model="form.address"
          required
          autofocus
          autocomplete="address"
        />
      </div>

      <div class="grid grid-cols-2 gap-5">
        <div>
          <jet-label for="birthday" value="Birth Day" />
          <jet-input
            id="birthday"
            type="date"
            class="mt-1 block w-full"
            v-model="form.birthday"
            required
            autofocus
            autocomplete="birthday"
          />
        </div>

        <div>
          <jet-label for="phoneNumber" value="Phone Number" />
          <jet-input
            id="phoneNumber"
            type="text"
            class="mt-1 block w-full"
            v-model="form.phoneNumber"
            required
            autofocus
            autocomplete="phoneNumber"
          />
        </div>
      </div>

      <div class="mt-4">
        <jet-label for="facebook" value="Facebook" />
        <jet-input
          id="facebook"
          type="text"
          class="mt-1 block w-full"
          v-model="form.facebook"
          required
        />
      </div>

      <div class="mt-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />
      </div>

      <div class="mt-4">
        <jet-label for="username" value="Username" />
        <jet-input
          id="username"
          type="text"
          class="mt-1 block w-full"
          v-model="form.username"
          required
        />
      </div>

      <div class="mt-4">
        <jet-label for="password" value="Password" />
        <jet-input
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-4">
        <jet-label for="password_confirmation" value="Confirm Password" />
        <jet-input
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />
      </div>

      <div
        class="mt-4"
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
      >
        <jet-label for="terms">
          <div class="flex items-center">
            <jet-checkbox
              name="terms"
              id="terms"
              v-model:checked="form.terms"
            />

            <div class="ml-2">
              I agree to the
              <a
                target="_blank"
                :href="route('terms.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Terms of Service</a
              >
              and
              <a
                target="_blank"
                :href="route('policy.show')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
                >Privacy Policy</a
              >
            </div>
          </div>
        </jet-label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <inertia-link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-900"
        >
          Already registered?
        </inertia-link>

        <jet-button
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </jet-button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetTextArea from "@/Jetstream/TextArea";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetTextArea,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
  },

  data() {
    return {
      form: this.$inertia.form({
        firstName: "",
        lastName: "",
        username: "",
        birthday: "",
        address: "",
        phoneNumber: "",
        email: "",
        facebook: "",
        password: "",
        password_confirmation: "",
        terms: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("register"), {
        onFinish: () => this.form.reset("password", "password_confirmation"),
      });
    },
  },
};
</script>
